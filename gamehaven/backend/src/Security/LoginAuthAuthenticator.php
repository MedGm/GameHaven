<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use App\Repository\UserRepository;

class LoginAuthAuthenticator extends AbstractAuthenticator
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    public function supports(Request $request): ?bool
    {
        return $request->getPathInfo() === '/api/login' && $request->isMethod('POST');
    }

    public function authenticate(Request $request): Passport
    {
        $data = json_decode($request->getContent(), true);
        
        if (!isset($data['username']) || !isset($data['password'])) {
            throw new AuthenticationException('Missing credentials');
        }

        return new Passport(
            new UserBadge($data['username']),
            new PasswordCredentials($data['password'])
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        $user = $token->getUser();
        return new JsonResponse([
            'message' => 'Login successful',
            'user' => [
                'username' => $user->getUserIdentifier(),
                'roles' => $user->getRoles()
            ]
        ]);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return new JsonResponse([
            'error' => 'Invalid credentials'
        ], Response::HTTP_UNAUTHORIZED);
    }
}
