<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Psr\Log\LoggerInterface;

#[Route('/api')]
class SecurityController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher,
        private LoggerInterface $logger
    ) {}

    #[Route('/login', name: 'api_login', methods: ['POST'])]
    public function login(): JsonResponse
    {
        // The authentication handler will handle this
        return $this->json(['message' => 'Authentication in progress']);
    }

    #[Route('/logout', name: 'app_logout', methods: ['GET', 'POST'])]
    public function logout(): never
    {
        // This should never be called
        throw new \Exception('This should never be called directly');
    }

    #[Route('/users/profile', name: 'api_profile', methods: ['GET'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function profile(): JsonResponse
    {
        return $this->json([
            'user' => [
                'id' => $this->getUser()->getId(),
                'email' => $this->getUser()->getEmail(),
                'username' => $this->getUser()->getUsername()
            ]
        ]);
    }

    #[Route('/debug/auth-test', name: 'api_debug_auth', methods: ['POST'])]
    #[IsGranted('PUBLIC_ACCESS')]
    public function debugAuth(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;

        if (!$email || !$password) {
            return $this->json(['error' => 'Missing credentials'], 400);
        }

        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
        
        if (!$user) {
            return $this->json(['error' => 'User not found'], 404);
        }

        $isValid = $this->passwordHasher->isPasswordValid($user, $password);

        return $this->json([
            'found_user' => true,
            'password_valid' => $isValid,
            'user_data' => [
                'email' => $user->getEmail(),
                'roles' => $user->getRoles(),
                'is_active' => $user->isActive()
            ]
        ]);
    }
}
