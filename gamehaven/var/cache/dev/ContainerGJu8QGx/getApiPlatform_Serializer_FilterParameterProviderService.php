<?php

namespace ContainerGJu8QGx;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getApiPlatform_Serializer_FilterParameterProviderService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'api_platform.serializer.filter_parameter_provider' shared service.
     *
     * @return \ApiPlatform\Serializer\Parameter\SerializerFilterParameterProvider
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/api-platform/state/ParameterProviderInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/api-platform/serializer/Parameter/SerializerFilterParameterProvider.php';

        return $container->privates['api_platform.serializer.filter_parameter_provider'] = new \ApiPlatform\Serializer\Parameter\SerializerFilterParameterProvider(($container->privates['api_platform.filter_locator'] ??= new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [], [])));
    }
}
