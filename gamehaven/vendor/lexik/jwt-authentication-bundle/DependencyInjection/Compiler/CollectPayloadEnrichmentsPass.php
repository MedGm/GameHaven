<?php

namespace Lexik\Bundle\JWTAuthenticationBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Compiler\PriorityTaggedServiceTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class CollectPayloadEnrichmentsPass implements CompilerPassInterface
{
    use PriorityTaggedServiceTrait;

    public function process(ContainerBuilder $container): void
    {
        if (!$container->hasDefinition('lexik_jwt_authentication.payload_enrichment')) {
            return;
        }

        $container->getDefinition('lexik_jwt_authentication.payload_enrichment')
            ->replaceArgument(0, $this->findAndSortTaggedServices('lexik_jwt_authentication.payload_enrichment', $container));
    }
}
