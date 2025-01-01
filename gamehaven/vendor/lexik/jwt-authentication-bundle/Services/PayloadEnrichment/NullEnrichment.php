<?php

namespace Lexik\Bundle\JWTAuthenticationBundle\Services\PayloadEnrichment;

use Lexik\Bundle\JWTAuthenticationBundle\Services\PayloadEnrichmentInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class NullEnrichment implements PayloadEnrichmentInterface
{
    public function enrich(UserInterface $user, array &$payload): void
    {
    }
}
