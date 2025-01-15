<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/api/users')]
class UserController extends AbstractController
{
    public function __construct(
        private UserService $userService,
        private UserPasswordHasherInterface $passwordHasher
    ) {}

    #[Route('/register', name: 'register_user', methods: ['POST'])]
    public function register(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        try {
            $user = $this->userService->createUser($data);
            return $this->json([
                'message' => 'User registered successfully',
                'user' => [
                    'id' => $user->getId(),
                    'email' => $user->getEmail(),
                    'username' => $user->getUsername()
                ]
            ], 201);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], 400);
        }
    }

    #[Route('/profile', name: 'get_user_profile', methods: ['GET'])]
    public function getProfile(): JsonResponse
    {
        // Add explicit authentication check
        $user = $this->getUser();
        if (!$user) {
            return $this->json(['error' => 'Unauthorized'], 401);
        }

        return $this->json([
            'user' => [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'username' => $user->getUsername(),
                'avatarUrl' => $user->getAvatarUrl()
            ]
        ]);
    }

    #[Route('/profile', name: 'update_user_profile', methods: ['PUT'])]
    public function updateProfile(Request $request): JsonResponse
    {
        // Add explicit authentication check
        $user = $this->getUser();
        if (!$user) {
            return $this->json(['error' => 'Unauthorized'], 401);
        }

        // Validate JSON content
        $content = $request->getContent();
        if (!$content || !json_decode($content)) {
            return $this->json(['error' => 'Invalid JSON format'], 400);
        }

        $data = json_decode($content, true);
        
        try {
            $updatedUser = $this->userService->updateUser($user, $data);
            return $this->json([
                'message' => 'Profile updated successfully',
                'user' => [
                    'id' => $updatedUser->getId(),
                    'email' => $updatedUser->getEmail(),
                    'username' => $updatedUser->getUsername(),
                    'avatarUrl' => $updatedUser->getAvatarUrl()
                ]
            ]);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], 400);
        }
    }

    #[Route('/admin/users', name: 'admin_list_users', methods: ['GET'])]
    public function listUsers(): JsonResponse
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        $users = $this->userService->getAllUsers();
        return $this->json([
            'users' => array_map(fn($user) => [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'username' => $user->getUsername(),
                'roles' => $user->getRoles(),
                'createdAt' => $user->getCreatedAt()->format('Y-m-d H:i:s')
            ], $users)
        ]);
    }

    #[Route('/admin/users/{id}/status', name: 'admin_update_user_status', methods: ['PUT'])]
    public function updateUserStatus(int $id, Request $request): JsonResponse
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        try {
            $data = json_decode($request->getContent(), true);
            $user = $this->userService->updateUserStatus($id, $data['active'] ?? false);
            
            return $this->json([
                'message' => 'User status updated',
                'user' => [
                    'id' => $user->getId(),
                    'email' => $user->getEmail(),
                    'active' => $user->isActive()
                ]
            ]);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], 400);
        }
    }
}
