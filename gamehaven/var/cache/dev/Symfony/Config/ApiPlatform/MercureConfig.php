<?php

namespace Symfony\Config\ApiPlatform;

use Symfony\Component\Config\Loader\ParamConfigurator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * This class is automatically generated to help in creating a config.
 */
class MercureConfig 
{
    private $enabled;
    private $hubUrl;
    private $includeType;
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
     * The URL sent in the Link HTTP header. If not set, will default to the URL for MercureBundle's default hub.
     * @default null
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function hubUrl($value): static
    {
        $this->_usedProperties['hubUrl'] = true;
        $this->hubUrl = $value;

        return $this;
    }

    /**
     * Always include @type in updates (including delete ones).
     * @default false
     * @param ParamConfigurator|bool $value
     * @return $this
     */
    public function includeType($value): static
    {
        $this->_usedProperties['includeType'] = true;
        $this->includeType = $value;

        return $this;
    }

    public function __construct(array $value = [])
    {
        if (array_key_exists('enabled', $value)) {
            $this->_usedProperties['enabled'] = true;
            $this->enabled = $value['enabled'];
            unset($value['enabled']);
        }

        if (array_key_exists('hub_url', $value)) {
            $this->_usedProperties['hubUrl'] = true;
            $this->hubUrl = $value['hub_url'];
            unset($value['hub_url']);
        }

        if (array_key_exists('include_type', $value)) {
            $this->_usedProperties['includeType'] = true;
            $this->includeType = $value['include_type'];
            unset($value['include_type']);
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
        if (isset($this->_usedProperties['hubUrl'])) {
            $output['hub_url'] = $this->hubUrl;
        }
        if (isset($this->_usedProperties['includeType'])) {
            $output['include_type'] = $this->includeType;
        }

        return $output;
    }

}
