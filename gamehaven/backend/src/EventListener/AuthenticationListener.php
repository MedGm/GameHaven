<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTInvalidEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class AuthenticationListener
{
    public function __construct(
        private LoggerInterface $logger,
        private RequestStack $requestStack
    ) {}

    public function onAuthenticationSuccess(AuthenticationSuccessEvent $event): void
    {
        $user = $event->getUser();
        $data = $event->getData();
        
        // Add user info to the JWT response
        $data['user'] = [
            'email' => $user->getEmail(),
            'roles' => $user->getRoles(),
            'username' => $user->getUsername()
        ];
        
        $event->setData($data);
        
        $this->logger->info('Authentication success', [
            'email' => $user->getEmail(),
            'roles' => $user->getRoles()
        ]);
    }

    public function onAuthenticationFailure(AuthenticationFailureEvent $event): void
    {
        $this->logger->error('Authentication failure', [
            'exception' => $event->getException()->getMessage(),
            'request' => $this->requestStack->getCurrentRequest()->getContent()
        ]);
    }

    public function onJWTInvalid(JWTInvalidEvent $event): void
    {
        $request = $this->requestStack->getCurrentRequest();
        $this->logger->error('Invalid JWT', [
            'exception' => $event->getException()->getMessage(),
            'request_uri' => $request->getRequestUri(),
            'request_method' => $request->getMethod(),
            'headers' => $request->headers->all()
        ]);
    }
}
