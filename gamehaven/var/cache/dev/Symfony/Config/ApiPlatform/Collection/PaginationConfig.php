<?php

namespace Symfony\Config\ApiPlatform\Collection;

use Symfony\Component\Config\Loader\ParamConfigurator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * This class is automatically generated to help in creating a config.
 */
class PaginationConfig 
{
    private $enabled;
    private $pageParameterName;
    private $enabledParameterName;
    private $itemsPerPageParameterName;
    private $partialParameterName;
    private $_usedProperties = [];

    /**
     * @default true
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
     * The default name of the parameter handling the page number.
     * @default 'page'
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function pageParameterName($value): static
    {
        $this->_usedProperties['pageParameterName'] = true;
        $this->pageParameterName = $value;

        return $this;
    }

    /**
     * The name of the query parameter to enable or disable pagination.
     * @default 'pagination'
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function enabledParameterName($value): static
    {
        $this->_usedProperties['enabledParameterName'] = true;
        $this->enabledParameterName = $value;

        return $this;
    }

    /**
     * The name of the query parameter to set the number of items per page.
     * @default 'itemsPerPage'
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function itemsPerPageParameterName($value): static
    {
        $this->_usedProperties['itemsPerPageParameterName'] = true;
        $this->itemsPerPageParameterName = $value;

        return $this;
    }

    /**
     * The name of the query parameter to enable or disable partial pagination.
     * @default 'partial'
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function partialParameterName($value): static
    {
        $this->_usedProperties['partialParameterName'] = true;
        $this->partialParameterName = $value;

        return $this;
    }

    public function __construct(array $value = [])
    {
        if (array_key_exists('enabled', $value)) {
            $this->_usedProperties['enabled'] = true;
            $this->enabled = $value['enabled'];
            unset($value['enabled']);
        }

        if (array_key_exists('page_parameter_name', $value)) {
            $this->_usedProperties['pageParameterName'] = true;
            $this->pageParameterName = $value['page_parameter_name'];
            unset($value['page_parameter_name']);
        }

        if (array_key_exists('enabled_parameter_name', $value)) {
            $this->_usedProperties['enabledParameterName'] = true;
            $this->enabledParameterName = $value['enabled_parameter_name'];
            unset($value['enabled_parameter_name']);
        }

        if (array_key_exists('items_per_page_parameter_name', $value)) {
            $this->_usedProperties['itemsPerPageParameterName'] = true;
            $this->itemsPerPageParameterName = $value['items_per_page_parameter_name'];
            unset($value['items_per_page_parameter_name']);
        }

        if (array_key_exists('partial_parameter_name', $value)) {
            $this->_usedProperties['partialParameterName'] = true;
            $this->partialParameterName = $value['partial_parameter_name'];
            unset($value['partial_parameter_name']);
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
        if (isset($this->_usedProperties['pageParameterName'])) {
            $output['page_parameter_name'] = $this->pageParameterName;
        }
        if (isset($this->_usedProperties['enabledParameterName'])) {
            $output['enabled_parameter_name'] = $this->enabledParameterName;
        }
        if (isset($this->_usedProperties['itemsPerPageParameterName'])) {
            $output['items_per_page_parameter_name'] = $this->itemsPerPageParameterName;
        }
        if (isset($this->_usedProperties['partialParameterName'])) {
            $output['partial_parameter_name'] = $this->partialParameterName;
        }

        return $output;
    }

}
