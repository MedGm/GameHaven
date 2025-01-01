<?php

namespace Symfony\Config\LexikJwtAuthentication\AccessTokenIssuance;

use Symfony\Component\Config\Loader\ParamConfigurator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * This class is automatically generated to help in creating a config.
 */
class EncryptionConfig 
{
    private $enabled;
    private $keyEncryptionAlgorithm;
    private $contentEncryptionAlgorithm;
    private $key;
    private $_usedProperties = [];

    /**
     * @default false
     * @param ParamConfigurator|bool $value
     * @return $this
     */
    public function enabled($value): static
    {
        $this->_usedProperties['enabled'] = true;
        $this->enabled = $value;

        return $this;
    }

    /**
     * The key encryption algorithm is used to encrypt the token.
     * @default null
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function keyEncryptionAlgorithm($value): static
    {
        $this->_usedProperties['keyEncryptionAlgorithm'] = true;
        $this->keyEncryptionAlgorithm = $value;

        return $this;
    }

    /**
     * The key encryption algorithm is used to encrypt the token.
     * @default null
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function contentEncryptionAlgorithm($value): static
    {
        $this->_usedProperties['contentEncryptionAlgorithm'] = true;
        $this->contentEncryptionAlgorithm = $value;

        return $this;
    }

    /**
     * The encryption key. It shall be JWK encoded.
     * @default null
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function key($value): static
    {
        $this->_usedProperties['key'] = true;
        $this->key = $value;

        return $this;
    }

    public function __construct(array $value = [])
    {
        if (array_key_exists('enabled', $value)) {
            $this->_usedProperties['enabled'] = true;
            $this->enabled = $value['enabled'];
            unset($value['enabled']);
        }

        if (array_key_exists('key_encryption_algorithm', $value)) {
            $this->_usedProperties['keyEncryptionAlgorithm'] = true;
            $this->keyEncryptionAlgorithm = $value['key_encryption_algorithm'];
            unset($value['key_encryption_algorithm']);
        }

        if (array_key_exists('content_encryption_algorithm', $value)) {
            $this->_usedProperties['contentEncryptionAlgorithm'] = true;
            $this->contentEncryptionAlgorithm = $value['content_encryption_algorithm'];
            unset($value['content_encryption_algorithm']);
        }

        if (array_key_exists('key', $value)) {
            $this->_usedProperties['key'] = true;
            $this->key = $value['key'];
            unset($value['key']);
        }

        if ([] !== $value) {
            throw new InvalidConfigurationException(sprintf('The following keys are not supported by "%s": ', __CLASS__).implode(', ', array_keys($value)));
        }
    }

    public function toArray(): array
    {
        $output = [];
        if (isset($this->_usedProperties['enabled'])) {
            $output['enabled'] = $this->enabled;
        }
        if (isset($this->_usedProperties['keyEncryptionAlgorithm'])) {
            $output['key_encryption_algorithm'] = $this->keyEncryptionAlgorithm;
        }
        if (isset($this->_usedProperties['contentEncryptionAlgorithm'])) {
            $output['content_encryption_algorithm'] = $this->contentEncryptionAlgorithm;
        }
        if (isset($this->_usedProperties['key'])) {
            $output['key'] = $this->key;
        }

        return $output;
    }

}
