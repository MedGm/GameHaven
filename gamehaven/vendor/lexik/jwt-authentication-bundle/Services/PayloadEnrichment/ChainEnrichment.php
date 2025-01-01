<?php

namespace Lexik\Bundle\JWTAuthenticationBundle\Services\PayloadEnrichment;

use Lexik\Bundle\JWTAuthenticationBundle\Services\PayloadEnrichmentInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class ChainEnrichment implements PayloadEnrichmentInterface
{
    private $enrichments;

    /**
     * @param PayloadEnrichmentInterface[] $enrichments
     */
    public function __construct(array $enrichments)
    {
        $this->enrichments = $enrichments;
    }

    public function enrich(UserInterface $user, array &$payload): void
    {
        foreach ($this->enrichments as $enrichment) {
            $enrichment->enrich($user, $payload);
        }
    }
}
