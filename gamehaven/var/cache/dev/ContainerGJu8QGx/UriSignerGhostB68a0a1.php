<?php

namespace ContainerGJu8QGx;
include_once \dirname(__DIR__, 4).'/vendor/symfony/http-foundation/UriSigner.php';

class UriSignerGhostB68a0a1 extends \Symfony\Component\HttpFoundation\UriSigner implements \Symfony\Component\VarExporter\LazyObjectInterface
{
    use \Symfony\Component\VarExporter\LazyGhostTrait;

    private const LAZY_OBJECT_PROPERTY_SCOPES = [
        "\0".parent::class."\0".'expirationParameter' => [parent::class, 'expirationParameter', null],
        "\0".parent::class."\0".'hashParameter' => [parent::class, 'hashParameter', null],
        "\0".parent::class."\0".'secret' => [parent::class, 'secret', null],
        'expirationParameter' => [parent::class, 'expirationParameter', null],
        'hashParameter' => [parent::class, 'hashParameter', null],
        'secret' => [parent::class, 'secret', null],
    ];
}

// Help opcache.preload discover always-needed symbols
class_exists(\Symfony\Component\VarExporter\Internal\Hydrator::class);
class_exists(\Symfony\Component\VarExporter\Internal\LazyObjectRegistry::class);
class_exists(\Symfony\Component\VarExporter\Internal\LazyObjectState::class);

if (!\class_exists('UriSignerGhostB68a0a1', false)) {
    \class_alias(__NAMESPACE__.'\\UriSignerGhostB68a0a1', 'UriSignerGhostB68a0a1', false);
}
