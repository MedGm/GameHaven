<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher
    ) {}

    public function createUser(array $data): User
    {
        // Validate data
        if (!isset($data['email']) || !isset($data['password']) || !isset($data['username'])) {
            throw new \InvalidArgumentException('Missing required fields');
        }

        // Validate email format
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email format');
        }

        // Validate password strength
        if (strlen($data['password']) < 8) {
            throw new \InvalidArgumentException('Password must be at least 8 characters long');
        }

        // Check if user exists (both email and username)
        $existingUser = $this->entityManager->getRepository(User::class)->findOneBy([
            'email' => $data['email']
        ]);
        if ($existingUser) {
            throw new \Exception('Email already registered');
        }

        $existingUsername = $this->entityManager->getRepository(User::class)->findOneBy([
            'username' => $data['username']
        ]);
        if ($existingUsername) {
            throw new \Exception('Username already taken');
        }

        // Create new user
        $user = new User();
        $user->setEmail($data['email']);
        $user->setUsername($data['username']);
        $user->setPassword(
            $this->passwordHasher->hashPassword($user, $data['password'])
        );
        $user->setRoles(['ROLE_USER']);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    public function updateUser(User $user, array $data): User
    {
        if (isset($data['username'])) {
            $user->setUsername($data['username']);
        }

        if (isset($data['avatarUrl'])) {
            $user->setAvatarUrl($data['avatarUrl']);
        }

        if (isset($data['password'])) {
            $user->setPassword(
                $this->passwordHasher->hashPassword($user, $data['password'])
            );
        }

        $this->entityManager->flush();

        return $user;
    }

    public function getAllUsers(): array
    {
        return $this->entityManager->getRepository(User::class)->findAll();
    }

    public function getUser(int $id): ?User
    {
        return $this->entityManager->getRepository(User::class)->find($id);
    }

    public function updateUserStatus(int $userId, bool $active): User
    {
        $user = $this->getUser($userId);
        if (!$user) {
            throw new \InvalidArgumentException('User not found');
        }

        $user->setActive($active);
        $this->entityManager->flush();

        return $user;
    }

    public function getUserStats(User $user): array
    {
        return [
            'listingsCount' => $user->getListings()->count(),
            'salesCount' => $this->entityManager->getRepository(Transaction::class)
                ->count(['seller' => $user, 'status' => 'completed']),
            'purchasesCount' => $this->entityManager->getRepository(Transaction::class)
                ->count(['buyer' => $user, 'status' => 'completed']),
            'averageRating' => $this->entityManager->getRepository(Review::class)
                ->getAverageRating($user)
        ];
    }
}