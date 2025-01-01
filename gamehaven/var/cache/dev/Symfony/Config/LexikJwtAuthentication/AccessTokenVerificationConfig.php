<?php

namespace Symfony\Config\LexikJwtAuthentication;

require_once __DIR__.\DIRECTORY_SEPARATOR.'AccessTokenVerification'.\DIRECTORY_SEPARATOR.'SignatureConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'AccessTokenVerification'.\DIRECTORY_SEPARATOR.'EncryptionConfig.php';

use Symfony\Component\Config\Loader\ParamConfigurator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * This class is automatically generated to help in creating a config.
 */
class AccessTokenVerificationConfig 
{
    private $enabled;
    private $signature;
    private $encryption;
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
     * @default {"header_checkers":[],"claim_checkers":["exp_with_clock_skew","iat_with_clock_skew","nbf_with_clock_skew"],"mandatory_claims":[],"allowed_algorithms":[]}
    */
    public function signature(array $value = []): \Symfony\Config\LexikJwtAuthentication\AccessTokenVerification\SignatureConfig
    {
        if (null === $this->signature) {
            $this->_usedProperties['signature'] = true;
            $this->signature = new \Symfony\Config\LexikJwtAuthentication\AccessTokenVerification\SignatureConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "signature()" has already been initialized. You cannot pass values the second time you call signature().');
        }

        return $this->signature;
    }

    /**
     * @template TValue
     * @param TValue $value
     * @default {"enabled":false,"continue_on_decryption_failure":false,"header_checkers":["iat_with_clock_skew","nbf_with_clock_skew","exp_with_clock_skew"],"allowed_key_encryption_algorithms":[],"allowed_content_encryption_algorithms":[]}
     * @return \Symfony\Config\LexikJwtAuthentication\AccessTokenVerification\EncryptionConfig|$this
     * @psalm-return (TValue is array ? \Symfony\Config\LexikJwtAuthentication\AccessTokenVerification\EncryptionConfig : static)
     */
    public function encryption(array $value = []): \Symfony\Config\LexikJwtAuthentication\AccessTokenVerification\EncryptionConfig|static
    {
        if (!\is_array($value)) {
            $this->_usedProperties['encryption'] = true;
            $this->encryption = $value;

            return $this;
        }

        if (!$this->encryption instanceof \Symfony\Config\LexikJwtAuthentication\AccessTokenVerification\EncryptionConfig) {
            $this->_usedProperties['encryption'] = true;
            $this->encryption = new \Symfony\Config\LexikJwtAuthentication\AccessTokenVerification\EncryptionConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "encryption()" has already been initialized. You cannot pass values the second time you call encryption().');
        }

        return $this->encryption;
    }

    public function __construct(array $value = [])
    {
        if (array_key_exists('enabled', $value)) {
            $this->_usedProperties['enabled'] = true;
            $this->enabled = $value['enabled'];
            unset($value['enabled']);
        }

        if (array_key_exists('signature', $value)) {
            $this->_usedProperties['signature'] = true;
            $this->signature = new \Symfony\Config\LexikJwtAuthentication\AccessTokenVerification\SignatureConfig($value['signature']);
            unset($value['signature']);
        }

        if (array_key_exists('encryption', $value)) {
            $this->_usedProperties['encryption'] = true;
            $this->encryption = \is_array($value['encryption']) ? new \Symfony\Config\LexikJwtAuthentication\AccessTokenVerification\EncryptionConfig($value['encryption']) : $value['encryption'];
            unset($value['encryption']);
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
        if (isset($this->_usedProperties['signature'])) {
            $output['signature'] = $this->signature->toArray();
        }
        if (isset($this->_usedProperties['encryption'])) {
            $output['encryption'] = $this->encryption instanceof \Symfony\Config\LexikJwtAuthentication\AccessTokenVerification\EncryptionConfig ? $this->encryption->toArray() : $this->encryption;
        }

        return $output;
    }

}
