<?php

namespace Symfony\Config\ApiPlatform;

use Symfony\Component\Config\Loader\ParamConfigurator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * This class is automatically generated to help in creating a config.
 */
class SerializerConfig 
{
    private $hydraPrefix;
    private $_usedProperties = [];

    /**
     * Use the "hydra:" prefix.
     * @default false
     * @param ParamConfigurator|bool $value
     * @return $this
     */
    public function hydraPrefix($value): static
    {
        $this->_usedProperties['hydraPrefix'] = true;
        $this->hydraPrefix = $value;

        return $this;
    }

    public function __construct(array $value = [])
    {
        if (array_key_exists('hydra_prefix', $value)) {
            $this->_usedProperties['hydraPrefix'] = true;
            $this->hydraPrefix = $value['hydra_prefix'];
            unset($value['hydra_prefix']);
        }

        if ([] !== $value) {
            throw new InvalidConfigurationException(sprintf('The following keys are not supported by "%s": ', __CLASS__).implode(', ', array_keys($value)));
        }
    }

    public function toArray(): array
    {
        $output = [];
        if (isset($this->_usedProperties['hydraPrefix'])) {
            $output['hydra_prefix'] = $this->hydraPrefix;
        }

        return $output;
    }

}
