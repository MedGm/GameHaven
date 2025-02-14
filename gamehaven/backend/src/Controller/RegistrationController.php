<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    public function __construct(
        private EmailVerifier $emailVerifier,
        private EntityManagerInterface $entityManager
    ) {
    }

    #[Route('/api/register', name: 'app_register', methods: ['POST'])]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);

            $user = new User();
            $user->setUsername($data['username']);
            $user->setEmail($data['email']);
            $user->setPassword(
                $passwordHasher->hashPassword($user, $data['password'])
            );
            $user->setRole('ROLE_USER');
            $user->setIsVerified(false);

            $entityManager->persist($user);
            $entityManager->flush();

            // Generate email verification
            $this->emailVerifier->sendEmailConfirmation(
                'app_verify_email',
                $user,
                (new TemplatedEmail())
                    ->from(new Address('gamehaven@example.com', 'GameHaven'))
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
                    ->context([
                        'user' => $user,
                    ])
            );

            return $this->json([
                'message' => 'User registered successfully. Please check your email for verification.',
                'id' => $user->getId()
            ], 201);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], 400);
        }
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request): Response
    {
        try {
            // Get user ID from query parameters
            $id = $request->get('id');
            if (!$id) {
                throw new \InvalidArgumentException('No user ID provided');
            }

            // Find user
            $user = $this->entityManager->getRepository(User::class)->find($id);
            if (!$user) {
                throw new \InvalidArgumentException('User not found');
            }

            // Validate email confirmation link
            try {
                $this->emailVerifier->handleEmailConfirmation($request, $user);
            } catch (VerifyEmailExceptionInterface $exception) {
                return $this->render('verification/error.html.twig', [
                    'error' => $exception->getReason()
                ]);
            }

            // Mark user as verified
            $user->setIsVerified(true);
            $this->entityManager->flush();

            return $this->render('verification/success.html.twig', [
                'username' => $user->getUserIdentifier()
            ]);
        } catch (\Exception $e) {
            return $this->render('verification/error.html.twig', [
                'error' => 'An error occurred during verification: ' . $e->getMessage()
            ]);
        }
    }
}
