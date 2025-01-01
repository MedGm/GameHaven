<?php

namespace Lexik\Bundle\JWTAuthenticationBundle\Services\KeyLoader;

/**
 * Interface for classes that are able to load crypto keys.
 *
 * @author Robin Chalas <robin.chalas@gmail.com>
 */
interface KeyLoaderInterface
{
    public const TYPE_PUBLIC = 'public';
    public const TYPE_PRIVATE = 'private';

    /**
     * Loads a key from a given type (public or private).
     *
     * @param resource|string|null $type
     *
     * @return resource|string|null
     */
    public function loadKey($type);

    public function getPassphrase(): ?string;

    public function getSigningKey(): ?string;

    public function getPublicKey(): ?string;

    public function getAdditionalPublicKeys(): array;
}
