<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Event\LogoutEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CustomLogoutSuccessHandler implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [LogoutEvent::class => 'onLogout'];
    }

    public function onLogout(LogoutEvent $event): void
    {
        $response = new JsonResponse(['message' => 'Logged out successfully']);
        $event->setResponse($response);
    }
}
