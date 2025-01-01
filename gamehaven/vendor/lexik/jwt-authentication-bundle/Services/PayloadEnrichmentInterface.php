<?php

namespace Lexik\Bundle\JWTAuthenticationBundle\Services;

use Symfony\Component\Security\Core\User\UserInterface;

interface PayloadEnrichmentInterface
{
    public function enrich(UserInterface $user, array &$payload): void;
}
