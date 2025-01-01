<?php

namespace Lexik\Bundle\JWTAuthenticationBundle\Services\PayloadEnrichment;

use Lexik\Bundle\JWTAuthenticationBundle\Services\PayloadEnrichmentInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class RandomJtiEnrichment implements PayloadEnrichmentInterface
{
    public function enrich(UserInterface $user, array &$payload): void
    {
        $payload['jti'] = bin2hex(random_bytes(16));
    }
}
