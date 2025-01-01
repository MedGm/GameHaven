<?php

namespace Symfony\Config\LexikJwtAuthentication\AccessTokenVerification;

use Symfony\Component\Config\Loader\ParamConfigurator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * This class is automatically generated to help in creating a config.
 */
class EncryptionConfig 
{
    private $enabled;
    private $continueOnDecryptionFailure;
    private $headerCheckers;
    private $allowedKeyEncryptionAlgorithms;
    private $allowedContentEncryptionAlgorithms;
    private $keyset;
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
     * If enable, non-encrypted tokens or tokens that failed during decryption or verification processes are accepted.
     * @default false
     * @param ParamConfigurator|bool $value
     * @return $this
     */
    public function continueOnDecryptionFailure($value): static
    {
        $this->_usedProperties['continueOnDecryptionFailure'] = true;
        $this->continueOnDecryptionFailure = $value;

        return $this;
    }

    /**
     * @param ParamConfigurator|list<ParamConfigurator|mixed> $value
     *
     * @return $this
     */
    public function headerCheckers(ParamConfigurator|array $value): static
    {
        $this->_usedProperties['headerCheckers'] = true;
        $this->headerCheckers = $value;

        return $this;
    }

    /**
     * @param ParamConfigurator|list<ParamConfigurator|mixed> $value
     *
     * @return $this
     */
    public function allowedKeyEncryptionAlgorithms(ParamConfigurator|array $value): static
    {
        $this->_usedProperties['allowedKeyEncryptionAlgorithms'] = true;
        $this->allowedKeyEncryptionAlgorithms = $value;

        return $this;
    }

    /**
     * @param ParamConfigurator|list<ParamConfigurator|mixed> $value
     *
     * @return $this
     */
    public function allowedContentEncryptionAlgorithms(ParamConfigurator|array $value): static
    {
        $this->_usedProperties['allowedContentEncryptionAlgorithms'] = true;
        $this->allowedContentEncryptionAlgorithms = $value;

        return $this;
    }

    /**
     * The encryption keyset. It shall be JWKSet encoded.
     * @default null
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function keyset($value): static
    {
        $this->_usedProperties['keyset'] = true;
        $this->keyset = $value;

        return $this;
    }

    public function __construct(array $value = [])
    {
        if (array_key_exists('enabled', $value)) {
            $this->_usedProperties['enabled'] = true;
            $this->enabled = $value['enabled'];
            unset($value['enabled']);
        }

        if (array_key_exists('continue_on_decryption_failure', $value)) {
            $this->_usedProperties['continueOnDecryptionFailure'] = true;
            $this->continueOnDecryptionFailure = $value['continue_on_decryption_failure'];
            unset($value['continue_on_decryption_failure']);
        }

        if (array_key_exists('header_checkers', $value)) {
            $this->_usedProperties['headerCheckers'] = true;
            $this->headerCheckers = $value['header_checkers'];
            unset($value['header_checkers']);
        }

        if (array_key_exists('allowed_key_encryption_algorithms', $value)) {
            $this->_usedProperties['allowedKeyEncryptionAlgorithms'] = true;
            $this->allowedKeyEncryptionAlgorithms = $value['allowed_key_encryption_algorithms'];
            unset($value['allowed_key_encryption_algorithms']);
        }

        if (array_key_exists('allowed_content_encryption_algorithms', $value)) {
            $this->_usedProperties['allowedContentEncryptionAlgorithms'] = true;
            $this->allowedContentEncryptionAlgorithms = $value['allowed_content_encryption_algorithms'];
            unset($value['allowed_content_encryption_algorithms']);
        }

        if (array_key_exists('keyset', $value)) {
            $this->_usedProperties['keyset'] = true;
            $this->keyset = $value['keyset'];
            unset($value['keyset']);
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
        if (isset($this->_usedProperties['continueOnDecryptionFailure'])) {
            $output['continue_on_decryption_failure'] = $this->continueOnDecryptionFailure;
        }
        if (isset($this->_usedProperties['headerCheckers'])) {
            $output['header_checkers'] = $this->headerCheckers;
        }
        if (isset($this->_usedProperties['allowedKeyEncryptionAlgorithms'])) {
            $output['allowed_key_encryption_algorithms'] = $this->allowedKeyEncryptionAlgorithms;
        }
        if (isset($this->_usedProperties['allowedContentEncryptionAlgorithms'])) {
            $output['allowed_content_encryption_algorithms'] = $this->allowedContentEncryptionAlgorithms;
        }
        if (isset($this->_usedProperties['keyset'])) {
            $output['keyset'] = $this->keyset;
        }

        return $output;
    }

}
