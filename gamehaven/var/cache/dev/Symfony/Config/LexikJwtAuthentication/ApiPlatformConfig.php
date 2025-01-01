<?php

namespace Symfony\Config\LexikJwtAuthentication;

use Symfony\Component\Config\Loader\ParamConfigurator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * This class is automatically generated to help in creating a config.
 */
class ApiPlatformConfig 
{
    private $enabled;
    private $checkPath;
    private $usernamePath;
    private $passwordPath;
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
     * The login check path to add in OpenAPI.
     * @default null
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function checkPath($value): static
    {
        $this->_usedProperties['checkPath'] = true;
        $this->checkPath = $value;

        return $this;
    }

    /**
     * The path to the username in the JSON body.
     * @default null
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function usernamePath($value): static
    {
        $this->_usedProperties['usernamePath'] = true;
        $this->usernamePath = $value;

        return $this;
    }

    /**
     * The path to the password in the JSON body.
     * @default null
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function passwordPath($value): static
    {
        $this->_usedProperties['passwordPath'] = true;
        $this->passwordPath = $value;

        return $this;
    }

    public function __construct(array $value = [])
    {
        if (array_key_exists('enabled', $value)) {
            $this->_usedProperties['enabled'] = true;
            $this->enabled = $value['enabled'];
            unset($value['enabled']);
        }

        if (array_key_exists('check_path', $value)) {
            $this->_usedProperties['checkPath'] = true;
            $this->checkPath = $value['check_path'];
            unset($value['check_path']);
        }

        if (array_key_exists('username_path', $value)) {
            $this->_usedProperties['usernamePath'] = true;
            $this->usernamePath = $value['username_path'];
            unset($value['username_path']);
        }

        if (array_key_exists('password_path', $value)) {
            $this->_usedProperties['passwordPath'] = true;
            $this->passwordPath = $value['password_path'];
            unset($value['password_path']);
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
        if (isset($this->_usedProperties['checkPath'])) {
            $output['check_path'] = $this->checkPath;
        }
        if (isset($this->_usedProperties['usernamePath'])) {
            $output['username_path'] = $this->usernamePath;
        }
        if (isset($this->_usedProperties['passwordPath'])) {
            $output['password_path'] = $this->passwordPath;
        }

        return $output;
    }

}
