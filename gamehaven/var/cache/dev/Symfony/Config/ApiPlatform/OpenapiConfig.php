<?php

namespace Symfony\Config\ApiPlatform;

require_once __DIR__.\DIRECTORY_SEPARATOR.'Openapi'.\DIRECTORY_SEPARATOR.'ContactConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'Openapi'.\DIRECTORY_SEPARATOR.'LicenseConfig.php';

use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\Loader\ParamConfigurator;

/**
 * This class is automatically generated to help in creating a config.
 */
class OpenapiConfig 
{
    private $contact;
    private $termsOfService;
    private $license;
    private $swaggerUiExtraConfiguration;
    private $overrideResponses;
    private $_usedProperties = [];

    /**
     * @default {"name":null,"url":null,"email":null}
    */
    public function contact(array $value = []): \Symfony\Config\ApiPlatform\Openapi\ContactConfig
    {
        if (null === $this->contact) {
            $this->_usedProperties['contact'] = true;
            $this->contact = new \Symfony\Config\ApiPlatform\Openapi\ContactConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "contact()" has already been initialized. You cannot pass values the second time you call contact().');
        }

        return $this->contact;
    }

    /**
     * A URL to the Terms of Service for the API. MUST be in the format of a URL.
     * @default null
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function termsOfService($value): static
    {
        $this->_usedProperties['termsOfService'] = true;
        $this->termsOfService = $value;

        return $this;
    }

    /**
     * @default {"name":null,"url":null}
    */
    public function license(array $value = []): \Symfony\Config\ApiPlatform\Openapi\LicenseConfig
    {
        if (null === $this->license) {
            $this->_usedProperties['license'] = true;
            $this->license = new \Symfony\Config\ApiPlatform\Openapi\LicenseConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "license()" has already been initialized. You cannot pass values the second time you call license().');
        }

        return $this->license;
    }

    /**
     * To pass extra configuration to Swagger UI, like docExpansion or filter.
     * @default array (
    )
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function swaggerUiExtraConfiguration(mixed $value = array (
    )): static
    {
        $this->_usedProperties['swaggerUiExtraConfiguration'] = true;
        $this->swaggerUiExtraConfiguration = $value;

        return $this;
    }

    /**
     * Whether API Platform adds automatic responses to the OpenAPI documentation.
     * @default true
     * @param ParamConfigurator|bool $value
     * @return $this
     */
    public function overrideResponses($value): static
    {
        $this->_usedProperties['overrideResponses'] = true;
        $this->overrideResponses = $value;

        return $this;
    }

    public function __construct(array $value = [])
    {
        if (array_key_exists('contact', $value)) {
            $this->_usedProperties['contact'] = true;
            $this->contact = new \Symfony\Config\ApiPlatform\Openapi\ContactConfig($value['contact']);
            unset($value['contact']);
        }

        if (array_key_exists('termsOfService', $value)) {
            $this->_usedProperties['termsOfService'] = true;
            $this->termsOfService = $value['termsOfService'];
            unset($value['termsOfService']);
        }

        if (array_key_exists('license', $value)) {
            $this->_usedProperties['license'] = true;
            $this->license = new \Symfony\Config\ApiPlatform\Openapi\LicenseConfig($value['license']);
            unset($value['license']);
        }

        if (array_key_exists('swagger_ui_extra_configuration', $value)) {
            $this->_usedProperties['swaggerUiExtraConfiguration'] = true;
            $this->swaggerUiExtraConfiguration = $value['swagger_ui_extra_configuration'];
            unset($value['swagger_ui_extra_configuration']);
        }

        if (array_key_exists('overrideResponses', $value)) {
            $this->_usedProperties['overrideResponses'] = true;
            $this->overrideResponses = $value['overrideResponses'];
            unset($value['overrideResponses']);
        }

        if ([] !== $value) {
            throw new InvalidConfigurationException(sprintf('The following keys are not supported by "%s": ', __CLASS__).implode(', ', array_keys($value)));
        }
    }

    public function toArray(): array
    {
        $output = [];
        if (isset($this->_usedProperties['contact'])) {
            $output['contact'] = $this->contact->toArray();
        }
        if (isset($this->_usedProperties['termsOfService'])) {
            $output['termsOfService'] = $this->termsOfService;
        }
        if (isset($this->_usedProperties['license'])) {
            $output['license'] = $this->license->toArray();
        }
        if (isset($this->_usedProperties['swaggerUiExtraConfiguration'])) {
            $output['swagger_ui_extra_configuration'] = $this->swaggerUiExtraConfiguration;
        }
        if (isset($this->_usedProperties['overrideResponses'])) {
            $output['overrideResponses'] = $this->overrideResponses;
        }

        return $output;
    }

}
