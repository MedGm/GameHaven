<?php

namespace ContainerGJu8QGx;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getApiPlatform_Openapi_SerializerContextBuilderService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'api_platform.openapi.serializer_context_builder' shared service.
     *
     * @return \ApiPlatform\OpenApi\Serializer\SerializerContextBuilder
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/api-platform/state/SerializerContextBuilderInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/api-platform/openapi/Serializer/SerializerContextBuilder.php';
        include_once \dirname(__DIR__, 4).'/vendor/api-platform/serializer/SerializerFilterContextBuilder.php';
        include_once \dirname(__DIR__, 4).'/vendor/api-platform/serializer/SerializerContextBuilder.php';

        $a = ($container->privates['api_platform.metadata.resource.metadata_collection_factory.cached'] ?? self::getApiPlatform_Metadata_Resource_MetadataCollectionFactory_CachedService($container));

        if (isset($container->privates['api_platform.openapi.serializer_context_builder'])) {
            return $container->privates['api_platform.openapi.serializer_context_builder'];
        }

        return $container->privates['api_platform.openapi.serializer_context_builder'] = new \ApiPlatform\OpenApi\Serializer\SerializerContextBuilder(new \ApiPlatform\Serializer\SerializerFilterContextBuilder($a, ($container->privates['api_platform.filter_locator'] ??= new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [], [])), new \ApiPlatform\Serializer\SerializerContextBuilder($a, true)));
    }
}
