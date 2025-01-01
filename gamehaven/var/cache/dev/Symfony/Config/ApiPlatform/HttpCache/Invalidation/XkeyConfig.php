<?php

namespace Symfony\Config\ApiPlatform\HttpCache\Invalidation;

use Symfony\Component\Config\Loader\ParamConfigurator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * This class is automatically generated to help in creating a config.
 */
class XkeyConfig 
{
    private $glue;
    private $_usedProperties = [];

    /**
     * xkey glue between keys
     * @default ' '
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function glue($value): static
    {
        $this->_usedProperties['glue'] = true;
        $this->glue = $value;

        return $this;
    }

    public function __construct(array $value = [])
    {
        if (array_key_exists('glue', $value)) {
            $this->_usedProperties['glue'] = true;
            $this->glue = $value['glue'];
            unset($value['glue']);
        }

        if ([] !== $value) {
            throw new InvalidConfigurationException(sprintf('The following keys are not supported by "%s": ', __CLASS__).implode(', ', array_keys($value)));
        }
    }

    public function toArray(): array
    {
        $output = [];
        if (isset($this->_usedProperties['glue'])) {
            $output['glue'] = $this->glue;
        }

        return $output;
    }

}
