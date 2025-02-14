<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[Route('/api/users', name: 'app_user_')]
class UserController extends AbstractController
{
    private function getFullAssetUrl(Request $request, string $path): string {
        return '//' . $request->getHttpHost() . $path;
    }

    #[Route('', methods: ['GET'], name: 'index')]
    public function getAllUsers(UserRepository $userRepository): JsonResponse
    {
        return $this->json($userRepository->findAll());
    }

    #[Route('/{id}', methods: ['GET'], name: 'show')]
    public function getUserById(Request $request, int $id, UserRepository $userRepository): JsonResponse
    {
        $user = $userRepository->find($id);
        if (!$user) {
            return $this->json(['message' => 'User not found'], 404);
        }

        $userData = [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'avatar_url' => $user->getAvatarUrl() ? $this->getFullAssetUrl($request, $user->getAvatarUrl()) : null,
            'is_verified' => $user->isVerified() // Include verification status
        ];

        return $this->json($userData);
    }

    #[Route('', methods: ['POST'], name: 'create')]
    public function createUser(
        Request $request, 
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher,
        UserRepository $userRepository
    ): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        // Validate required fields
        if (!isset($data['username']) || !isset($data['email']) || !isset($data['password'])) {
            return $this->json(['message' => 'Missing required fields'], 400);
        }

        // Check if username or email already exists
        if ($userRepository->findByUsername($data['username'])) {
            return $this->json(['message' => 'Username already exists'], 400);
        }

        if ($userRepository->findOneBy(['email' => $data['email']])) {
            return $this->json(['message' => 'Email already exists'], 400);
        }

        $user = new User();
        $user->setUsername($data['username']);
        $user->setEmail($data['email']);
        $user->setPassword($passwordHasher->hashPassword($user, $data['password']));
        
        $em->persist($user);
        $em->flush();
        
        return $this->json([
            'message' => 'User created successfully',
            'id' => $user->getId()
        ], 201);
    }

    #[Route('/{id}', methods: ['PUT'], name: 'update')]
    public function updateUser(
        int $id, 
        Request $request, 
        EntityManagerInterface $em,
        UserRepository $userRepository,
        UserPasswordHasherInterface $passwordHasher
    ): JsonResponse
    {
        $user = $userRepository->find($id);
        if (!$user) {
            return $this->json(['message' => 'User not found'], 404);
        }

        if ($user !== $this->getUser()) {
            return $this->json(['message' => 'Not authorized'], 403);
        }

        $data = json_decode($request->getContent(), true);
        
        if (isset($data['email'])) {
            $existingUser = $userRepository->findOneBy(['email' => $data['email']]);
            if ($existingUser && $existingUser !== $user) {
                return $this->json(['message' => 'Email already exists'], 400);
            }
            $user->setEmail($data['email']);
        }

        if (isset($data['password'])) {
            $user->setPassword($passwordHasher->hashPassword($user, $data['password']));
        }

        if (isset($data['avatar_url'])) {
            $user->setAvatarUrl($data['avatar_url']);
        }

        $em->flush();
        
        return $this->json(['message' => 'User updated successfully']);
    }

    #[Route('/{id}', methods: ['DELETE'], name: 'delete')]
    public function deleteUser(
        int $id, 
        EntityManagerInterface $em,
        UserRepository $userRepository
    ): JsonResponse
    {
        $user = $userRepository->find($id);
        if (!$user) {
            return $this->json(['message' => 'User not found'], 404);
        }

        $em->remove($user);
        $em->flush();
        
        return $this->json(['message' => 'User deleted successfully']);
    }

    #[Route('/{id}/avatar', methods: ['POST'], name: 'update_avatar')]
    public function updateAvatar(
        int $id,
        Request $request,
        UserRepository $userRepository,
        EntityManagerInterface $em
    ): JsonResponse {
        try {
            $user = $userRepository->find($id);
            if (!$user) {
                return $this->json(['message' => 'User not found'], 404);
            }

            /** @var UploadedFile|null $file */
            $file = $request->files->get('avatar');
            if (!$file) {
                return $this->json(['message' => 'No file uploaded'], 400);
            }

            if (!$file->isValid()) {
                return $this->json(['message' => 'Invalid file upload'], 400);
            }

            $uploadDir = $this->getParameter('avatar_directory');
            if (!file_exists($uploadDir)) {
                if (!mkdir($uploadDir, 0777, true) && !is_dir($uploadDir)) {
                    throw new \RuntimeException(sprintf('Directory "%s" was not created', $uploadDir));
                }
                chmod($uploadDir, 0777);
            }

            $oldAvatarPath = $user->getAvatarUrl();
            if ($oldAvatarPath) {
                $oldFilePath = $this->getParameter('kernel.project_dir') . '/public' . $oldAvatarPath;
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            $newFilename = sprintf('avatar-%s-%s.%s', 
                $user->getId(),
                uniqid(),
                $file->guessExtension() ?? 'png'
            );

            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $mimeType = $file->getMimeType();
            if (!in_array($mimeType, $allowedMimeTypes)) {
                return $this->json(['message' => 'Only JPG, PNG and GIF images are allowed'], 400);
            }

            try {
                $file->move($uploadDir, $newFilename);
                chmod($uploadDir . '/' . $newFilename, 0777);
            } catch (\Exception $e) {
                return $this->json(['message' => 'Failed to move uploaded file: ' . $e->getMessage()], 500);
            }

            $avatarUrl = '/uploads/avatars/' . $newFilename;
            $user->setAvatarUrl($avatarUrl);
            $em->flush();

            return $this->json([
                'message' => 'Avatar updated successfully',
                'avatar_url' => $this->getFullAssetUrl($request, $avatarUrl)
            ]);

        } catch (\Exception $e) {
            return $this->json([
                'message' => 'Failed to upload avatar: ' . $e->getMessage()
            ], 500);
        }
    }
}