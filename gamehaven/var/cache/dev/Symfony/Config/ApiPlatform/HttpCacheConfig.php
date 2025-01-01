<?php

namespace Symfony\Config\ApiPlatform;

require_once __DIR__.\DIRECTORY_SEPARATOR.'HttpCache'.\DIRECTORY_SEPARATOR.'InvalidationConfig.php';

use Symfony\Component\Config\Loader\ParamConfigurator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * This class is automatically generated to help in creating a config.
 */
class HttpCacheConfig 
{
    private $public;
    private $invalidation;
    private $_usedProperties = [];

    /**
     * To make all responses public by default.
     * @default null
     * @param ParamConfigurator|bool $value
     * @return $this
     */
    public function public($value): static
    {
        $this->_usedProperties['public'] = true;
        $this->public = $value;

        return $this;
    }

    /**
     * @template TValue
     * @param TValue $value
     * Enable the tags-based cache invalidation system.
     * @default {"enabled":false,"varnish_urls":[],"urls":[],"scoped_clients":[],"max_header_length":7500,"request_options":[],"purger":"api_platform.http_cache.purger.varnish","xkey":{"glue":" "}}
     * @return \Symfony\Config\ApiPlatform\HttpCache\InvalidationConfig|$this
     * @psalm-return (TValue is array ? \Symfony\Config\ApiPlatform\HttpCache\InvalidationConfig : static)
     */
    public function invalidation(array $value = []): \Symfony\Config\ApiPlatform\HttpCache\InvalidationConfig|static
    {
        if (!\is_array($value)) {
            $this->_usedProperties['invalidation'] = true;
            $this->invalidation = $value;

            return $this;
        }

        if (!$this->invalidation instanceof \Symfony\Config\ApiPlatform\HttpCache\InvalidationConfig) {
            $this->_usedProperties['invalidation'] = true;
            $this->invalidation = new \Symfony\Config\ApiPlatform\HttpCache\InvalidationConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "invalidation()" has already been initialized. You cannot pass values the second time you call invalidation().');
        }

        return $this->invalidation;
    }

    public function __construct(array $value = [])
    {
        if (array_key_exists('public', $value)) {
            $this->_usedProperties['public'] = true;
            $this->public = $value['public'];
            unset($value['public']);
        }

        if (array_key_exists('invalidation', $value)) {
            $this->_usedProperties['invalidation'] = true;
            $this->invalidation = \is_array($value['invalidation']) ? new \Symfony\Config\ApiPlatform\HttpCache\InvalidationConfig($value['invalidation']) : $value['invalidation'];
            unset($value['invalidation']);
        }

        if ([] !== $value) {
            throw new InvalidConfigurationException(sprintf('The following keys are not supported by "%s": ', __CLASS__).implode(', ', array_keys($value)));
        }
    }

    public function toArray(): array
    {
        $output = [];
        if (isset($this->_usedProperties['public'])) {
            $output['public'] = $this->public;
        }
        if (isset($this->_usedProperties['invalidation'])) {
            $output['invalidation'] = $this->invalidation instanceof \Symfony\Config\ApiPlatform\HttpCache\InvalidationConfig ? $this->invalidation->toArray() : $this->invalidation;
        }

        return $output;
    }

}
