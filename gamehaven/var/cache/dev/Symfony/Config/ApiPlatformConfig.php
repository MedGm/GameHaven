<?php

namespace Symfony\Config;

require_once __DIR__.\DIRECTORY_SEPARATOR.'ApiPlatform'.\DIRECTORY_SEPARATOR.'ValidatorConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'ApiPlatform'.\DIRECTORY_SEPARATOR.'EagerLoadingConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'ApiPlatform'.\DIRECTORY_SEPARATOR.'CollectionConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'ApiPlatform'.\DIRECTORY_SEPARATOR.'MappingConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'ApiPlatform'.\DIRECTORY_SEPARATOR.'SerializerConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'ApiPlatform'.\DIRECTORY_SEPARATOR.'DoctrineConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'ApiPlatform'.\DIRECTORY_SEPARATOR.'DoctrineMongodbOdmConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'ApiPlatform'.\DIRECTORY_SEPARATOR.'OauthConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'ApiPlatform'.\DIRECTORY_SEPARATOR.'GraphqlConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'ApiPlatform'.\DIRECTORY_SEPARATOR.'SwaggerConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'ApiPlatform'.\DIRECTORY_SEPARATOR.'HttpCacheConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'ApiPlatform'.\DIRECTORY_SEPARATOR.'MercureConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'ApiPlatform'.\DIRECTORY_SEPARATOR.'MessengerConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'ApiPlatform'.\DIRECTORY_SEPARATOR.'ElasticsearchConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'ApiPlatform'.\DIRECTORY_SEPARATOR.'OpenapiConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'ApiPlatform'.\DIRECTORY_SEPARATOR.'MakerConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'ApiPlatform'.\DIRECTORY_SEPARATOR.'FormatsConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'ApiPlatform'.\DIRECTORY_SEPARATOR.'PatchFormatsConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'ApiPlatform'.\DIRECTORY_SEPARATOR.'DocsFormatsConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'ApiPlatform'.\DIRECTORY_SEPARATOR.'ErrorFormatsConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'ApiPlatform'.\DIRECTORY_SEPARATOR.'DefaultsConfig.php';

use Symfony\Component\Config\Loader\ParamConfigurator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * This class is automatically generated to help in creating a config.
 */
class ApiPlatformConfig implements \Symfony\Component\Config\Builder\ConfigBuilderInterface
{
    private $title;
    private $description;
    private $version;
    private $showWebby;
    private $useSymfonyListeners;
    private $nameConverter;
    private $assetPackage;
    private $pathSegmentNameGenerator;
    private $inflector;
    private $validator;
    private $eagerLoading;
    private $handleSymfonyErrors;
    private $enableSwagger;
    private $enableSwaggerUi;
    private $enableReDoc;
    private $enableEntrypoint;
    private $enableDocs;
    private $enableProfiler;
    private $enableLinkSecurity;
    private $collection;
    private $mapping;
    private $resourceClassDirectories;
    private $serializer;
    private $doctrine;
    private $doctrineMongodbOdm;
    private $oauth;
    private $graphql;
    private $swagger;
    private $httpCache;
    private $mercure;
    private $messenger;
    private $elasticsearch;
    private $openapi;
    private $maker;
    private $exceptionToStatus;
    private $formats;
    private $patchFormats;
    private $docsFormats;
    private $errorFormats;
    private $jsonschemaFormats;
    private $defaults;
    private $_usedProperties = [];

    /**
     * The title of the API.
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function title($value): static
    {
        $this->_usedProperties['title'] = true;
        $this->title = $value;

        return $this;
    }

    /**
     * The description of the API.
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function description($value): static
    {
        $this->_usedProperties['description'] = true;
        $this->description = $value;

        return $this;
    }

    /**
     * The version of the API.
     * @default '0.0.0'
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function version($value): static
    {
        $this->_usedProperties['version'] = true;
        $this->version = $value;

        return $this;
    }

    /**
     * If true, show Webby on the documentation page
     * @default true
     * @param ParamConfigurator|bool $value
     * @return $this
     */
    public function showWebby($value): static
    {
        $this->_usedProperties['showWebby'] = true;
        $this->showWebby = $value;

        return $this;
    }

    /**
     * Uses Symfony event listeners instead of the ApiPlatform\Symfony\Controller\MainController.
     * @default false
     * @param ParamConfigurator|bool $value
     * @return $this
     */
    public function useSymfonyListeners($value): static
    {
        $this->_usedProperties['useSymfonyListeners'] = true;
        $this->useSymfonyListeners = $value;

        return $this;
    }

    /**
     * Specify a name converter to use.
     * @default null
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function nameConverter($value): static
    {
        $this->_usedProperties['nameConverter'] = true;
        $this->nameConverter = $value;

        return $this;
    }

    /**
     * Specify an asset package name to use.
     * @default null
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function assetPackage($value): static
    {
        $this->_usedProperties['assetPackage'] = true;
        $this->assetPackage = $value;

        return $this;
    }

    /**
     * Specify a path name generator to use.
     * @default 'api_platform.metadata.path_segment_name_generator.underscore'
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function pathSegmentNameGenerator($value): static
    {
        $this->_usedProperties['pathSegmentNameGenerator'] = true;
        $this->pathSegmentNameGenerator = $value;

        return $this;
    }

    /**
     * Specify an inflector to use.
     * @default 'api_platform.metadata.inflector'
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function inflector($value): static
    {
        $this->_usedProperties['inflector'] = true;
        $this->inflector = $value;

        return $this;
    }

    /**
     * @default {"serialize_payload_fields":[],"query_parameter_validation":true}
    */
    public function validator(array $value = []): \Symfony\Config\ApiPlatform\ValidatorConfig
    {
        if (null === $this->validator) {
            $this->_usedProperties['validator'] = true;
            $this->validator = new \Symfony\Config\ApiPlatform\ValidatorConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "validator()" has already been initialized. You cannot pass values the second time you call validator().');
        }

        return $this->validator;
    }

    /**
     * @default {"enabled":true,"fetch_partial":false,"max_joins":30,"force_eager":true}
    */
    public function eagerLoading(array $value = []): \Symfony\Config\ApiPlatform\EagerLoadingConfig
    {
        if (null === $this->eagerLoading) {
            $this->_usedProperties['eagerLoading'] = true;
            $this->eagerLoading = new \Symfony\Config\ApiPlatform\EagerLoadingConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "eagerLoading()" has already been initialized. You cannot pass values the second time you call eagerLoading().');
        }

        return $this->eagerLoading;
    }

    /**
     * Allows to handle symfony exceptions.
     * @default false
     * @param ParamConfigurator|bool $value
     * @return $this
     */
    public function handleSymfonyErrors($value): static
    {
        $this->_usedProperties['handleSymfonyErrors'] = true;
        $this->handleSymfonyErrors = $value;

        return $this;
    }

    /**
     * Enable the Swagger documentation and export.
     * @default true
     * @param ParamConfigurator|bool $value
     * @return $this
     */
    public function enableSwagger($value): static
    {
        $this->_usedProperties['enableSwagger'] = true;
        $this->enableSwagger = $value;

        return $this;
    }

    /**
     * Enable Swagger UI
     * @default true
     * @param ParamConfigurator|bool $value
     * @return $this
     */
    public function enableSwaggerUi($value): static
    {
        $this->_usedProperties['enableSwaggerUi'] = true;
        $this->enableSwaggerUi = $value;

        return $this;
    }

    /**
     * Enable ReDoc
     * @default true
     * @param ParamConfigurator|bool $value
     * @return $this
     */
    public function enableReDoc($value): static
    {
        $this->_usedProperties['enableReDoc'] = true;
        $this->enableReDoc = $value;

        return $this;
    }

    /**
     * Enable the entrypoint
     * @default true
     * @param ParamConfigurator|bool $value
     * @return $this
     */
    public function enableEntrypoint($value): static
    {
        $this->_usedProperties['enableEntrypoint'] = true;
        $this->enableEntrypoint = $value;

        return $this;
    }

    /**
     * Enable the docs
     * @default true
     * @param ParamConfigurator|bool $value
     * @return $this
     */
    public function enableDocs($value): static
    {
        $this->_usedProperties['enableDocs'] = true;
        $this->enableDocs = $value;

        return $this;
    }

    /**
     * Enable the data collector and the WebProfilerBundle integration.
     * @default true
     * @param ParamConfigurator|bool $value
     * @return $this
     */
    public function enableProfiler($value): static
    {
        $this->_usedProperties['enableProfiler'] = true;
        $this->enableProfiler = $value;

        return $this;
    }

    /**
     * Enable security for Links (sub resources)
     * @default false
     * @param ParamConfigurator|bool $value
     * @return $this
     */
    public function enableLinkSecurity($value): static
    {
        $this->_usedProperties['enableLinkSecurity'] = true;
        $this->enableLinkSecurity = $value;

        return $this;
    }

    /**
     * @default {"exists_parameter_name":"exists","order":"ASC","order_parameter_name":"order","order_nulls_comparison":null,"pagination":{"enabled":true,"page_parameter_name":"page","enabled_parameter_name":"pagination","items_per_page_parameter_name":"itemsPerPage","partial_parameter_name":"partial"}}
    */
    public function collection(array $value = []): \Symfony\Config\ApiPlatform\CollectionConfig
    {
        if (null === $this->collection) {
            $this->_usedProperties['collection'] = true;
            $this->collection = new \Symfony\Config\ApiPlatform\CollectionConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "collection()" has already been initialized. You cannot pass values the second time you call collection().');
        }

        return $this->collection;
    }

    /**
     * @default {"paths":[]}
    */
    public function mapping(array $value = []): \Symfony\Config\ApiPlatform\MappingConfig
    {
        if (null === $this->mapping) {
            $this->_usedProperties['mapping'] = true;
            $this->mapping = new \Symfony\Config\ApiPlatform\MappingConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "mapping()" has already been initialized. You cannot pass values the second time you call mapping().');
        }

        return $this->mapping;
    }

    /**
     * @param ParamConfigurator|list<ParamConfigurator|mixed> $value
     *
     * @return $this
     */
    public function resourceClassDirectories(ParamConfigurator|array $value): static
    {
        $this->_usedProperties['resourceClassDirectories'] = true;
        $this->resourceClassDirectories = $value;

        return $this;
    }

    /**
     * @default {"hydra_prefix":false}
    */
    public function serializer(array $value = []): \Symfony\Config\ApiPlatform\SerializerConfig
    {
        if (null === $this->serializer) {
            $this->_usedProperties['serializer'] = true;
            $this->serializer = new \Symfony\Config\ApiPlatform\SerializerConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "serializer()" has already been initialized. You cannot pass values the second time you call serializer().');
        }

        return $this->serializer;
    }

    /**
     * @default {"enabled":true}
    */
    public function doctrine(array $value = []): \Symfony\Config\ApiPlatform\DoctrineConfig
    {
        if (null === $this->doctrine) {
            $this->_usedProperties['doctrine'] = true;
            $this->doctrine = new \Symfony\Config\ApiPlatform\DoctrineConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "doctrine()" has already been initialized. You cannot pass values the second time you call doctrine().');
        }

        return $this->doctrine;
    }

    /**
     * @template TValue
     * @param TValue $value
     * @default {"enabled":false}
     * @return \Symfony\Config\ApiPlatform\DoctrineMongodbOdmConfig|$this
     * @psalm-return (TValue is array ? \Symfony\Config\ApiPlatform\DoctrineMongodbOdmConfig : static)
     */
    public function doctrineMongodbOdm(array $value = []): \Symfony\Config\ApiPlatform\DoctrineMongodbOdmConfig|static
    {
        if (!\is_array($value)) {
            $this->_usedProperties['doctrineMongodbOdm'] = true;
            $this->doctrineMongodbOdm = $value;

            return $this;
        }

        if (!$this->doctrineMongodbOdm instanceof \Symfony\Config\ApiPlatform\DoctrineMongodbOdmConfig) {
            $this->_usedProperties['doctrineMongodbOdm'] = true;
            $this->doctrineMongodbOdm = new \Symfony\Config\ApiPlatform\DoctrineMongodbOdmConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "doctrineMongodbOdm()" has already been initialized. You cannot pass values the second time you call doctrineMongodbOdm().');
        }

        return $this->doctrineMongodbOdm;
    }

    /**
     * @template TValue
     * @param TValue $value
     * @default {"enabled":false,"clientId":"","clientSecret":"","pkce":false,"type":"oauth2","flow":"application","tokenUrl":"","authorizationUrl":"","refreshUrl":"","scopes":[]}
     * @return \Symfony\Config\ApiPlatform\OauthConfig|$this
     * @psalm-return (TValue is array ? \Symfony\Config\ApiPlatform\OauthConfig : static)
     */
    public function oauth(array $value = []): \Symfony\Config\ApiPlatform\OauthConfig|static
    {
        if (!\is_array($value)) {
            $this->_usedProperties['oauth'] = true;
            $this->oauth = $value;

            return $this;
        }

        if (!$this->oauth instanceof \Symfony\Config\ApiPlatform\OauthConfig) {
            $this->_usedProperties['oauth'] = true;
            $this->oauth = new \Symfony\Config\ApiPlatform\OauthConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "oauth()" has already been initialized. You cannot pass values the second time you call oauth().');
        }

        return $this->oauth;
    }

    /**
     * @template TValue
     * @param TValue $value
     * @default {"enabled":false,"default_ide":"graphiql","graphiql":{"enabled":false},"graphql_playground":{"enabled":false},"introspection":{"enabled":true},"nesting_separator":"_","collection":{"pagination":{"enabled":true}}}
     * @return \Symfony\Config\ApiPlatform\GraphqlConfig|$this
     * @psalm-return (TValue is array ? \Symfony\Config\ApiPlatform\GraphqlConfig : static)
     */
    public function graphql(array $value = []): \Symfony\Config\ApiPlatform\GraphqlConfig|static
    {
        if (!\is_array($value)) {
            $this->_usedProperties['graphql'] = true;
            $this->graphql = $value;

            return $this;
        }

        if (!$this->graphql instanceof \Symfony\Config\ApiPlatform\GraphqlConfig) {
            $this->_usedProperties['graphql'] = true;
            $this->graphql = new \Symfony\Config\ApiPlatform\GraphqlConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "graphql()" has already been initialized. You cannot pass values the second time you call graphql().');
        }

        return $this->graphql;
    }

    /**
     * @default {"versions":[3],"api_keys":[],"swagger_ui_extra_configuration":[]}
    */
    public function swagger(array $value = []): \Symfony\Config\ApiPlatform\SwaggerConfig
    {
        if (null === $this->swagger) {
            $this->_usedProperties['swagger'] = true;
            $this->swagger = new \Symfony\Config\ApiPlatform\SwaggerConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "swagger()" has already been initialized. You cannot pass values the second time you call swagger().');
        }

        return $this->swagger;
    }

    /**
     * @default {"public":null,"invalidation":{"enabled":false,"varnish_urls":[],"urls":[],"scoped_clients":[],"max_header_length":7500,"request_options":[],"purger":"api_platform.http_cache.purger.varnish","xkey":{"glue":" "}}}
    */
    public function httpCache(array $value = []): \Symfony\Config\ApiPlatform\HttpCacheConfig
    {
        if (null === $this->httpCache) {
            $this->_usedProperties['httpCache'] = true;
            $this->httpCache = new \Symfony\Config\ApiPlatform\HttpCacheConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "httpCache()" has already been initialized. You cannot pass values the second time you call httpCache().');
        }

        return $this->httpCache;
    }

    /**
     * @template TValue
     * @param TValue $value
     * @default {"enabled":false,"hub_url":null,"include_type":false}
     * @return \Symfony\Config\ApiPlatform\MercureConfig|$this
     * @psalm-return (TValue is array ? \Symfony\Config\ApiPlatform\MercureConfig : static)
     */
    public function mercure(array $value = []): \Symfony\Config\ApiPlatform\MercureConfig|static
    {
        if (!\is_array($value)) {
            $this->_usedProperties['mercure'] = true;
            $this->mercure = $value;

            return $this;
        }

        if (!$this->mercure instanceof \Symfony\Config\ApiPlatform\MercureConfig) {
            $this->_usedProperties['mercure'] = true;
            $this->mercure = new \Symfony\Config\ApiPlatform\MercureConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "mercure()" has already been initialized. You cannot pass values the second time you call mercure().');
        }

        return $this->mercure;
    }

    /**
     * @default {"enabled":true}
    */
    public function messenger(array $value = []): \Symfony\Config\ApiPlatform\MessengerConfig
    {
        if (null === $this->messenger) {
            $this->_usedProperties['messenger'] = true;
            $this->messenger = new \Symfony\Config\ApiPlatform\MessengerConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "messenger()" has already been initialized. You cannot pass values the second time you call messenger().');
        }

        return $this->messenger;
    }

    /**
     * @template TValue
     * @param TValue $value
     * @default {"enabled":false,"hosts":[]}
     * @return \Symfony\Config\ApiPlatform\ElasticsearchConfig|$this
     * @psalm-return (TValue is array ? \Symfony\Config\ApiPlatform\ElasticsearchConfig : static)
     */
    public function elasticsearch(array $value = []): \Symfony\Config\ApiPlatform\ElasticsearchConfig|static
    {
        if (!\is_array($value)) {
            $this->_usedProperties['elasticsearch'] = true;
            $this->elasticsearch = $value;

            return $this;
        }

        if (!$this->elasticsearch instanceof \Symfony\Config\ApiPlatform\ElasticsearchConfig) {
            $this->_usedProperties['elasticsearch'] = true;
            $this->elasticsearch = new \Symfony\Config\ApiPlatform\ElasticsearchConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "elasticsearch()" has already been initialized. You cannot pass values the second time you call elasticsearch().');
        }

        return $this->elasticsearch;
    }

    /**
     * @default {"contact":{"name":null,"url":null,"email":null},"termsOfService":null,"license":{"name":null,"url":null},"swagger_ui_extra_configuration":[],"overrideResponses":true}
    */
    public function openapi(array $value = []): \Symfony\Config\ApiPlatform\OpenapiConfig
    {
        if (null === $this->openapi) {
            $this->_usedProperties['openapi'] = true;
            $this->openapi = new \Symfony\Config\ApiPlatform\OpenapiConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "openapi()" has already been initialized. You cannot pass values the second time you call openapi().');
        }

        return $this->openapi;
    }

    /**
     * @default {"enabled":true}
    */
    public function maker(array $value = []): \Symfony\Config\ApiPlatform\MakerConfig
    {
        if (null === $this->maker) {
            $this->_usedProperties['maker'] = true;
            $this->maker = new \Symfony\Config\ApiPlatform\MakerConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "maker()" has already been initialized. You cannot pass values the second time you call maker().');
        }

        return $this->maker;
    }

    /**
     * @return $this
     */
    public function exceptionToStatus(string $exception_class, ParamConfigurator|int $value): static
    {
        $this->_usedProperties['exceptionToStatus'] = true;
        $this->exceptionToStatus[$exception_class] = $value;

        return $this;
    }

    /**
     * @template TValue
     * @param TValue $value
     * The list of enabled formats. The first one will be the default.
     * @default {"jsonld":{"mime_types":["application\/ld+json"]}}
     * @return \Symfony\Config\ApiPlatform\FormatsConfig|$this
     * @psalm-return (TValue is array ? \Symfony\Config\ApiPlatform\FormatsConfig : static)
     */
    public function formats(string $format, array $value = []): \Symfony\Config\ApiPlatform\FormatsConfig|static
    {
        if (!\is_array($value)) {
            $this->_usedProperties['formats'] = true;
            $this->formats[$format] = $value;

            return $this;
        }

        if (!isset($this->formats[$format]) || !$this->formats[$format] instanceof \Symfony\Config\ApiPlatform\FormatsConfig) {
            $this->_usedProperties['formats'] = true;
            $this->formats[$format] = new \Symfony\Config\ApiPlatform\FormatsConfig($value);
        } elseif (1 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "formats()" has already been initialized. You cannot pass values the second time you call formats().');
        }

        return $this->formats[$format];
    }

    /**
     * @template TValue
     * @param TValue $value
     * The list of enabled formats. The first one will be the default.
     * @default {"json":{"mime_types":["application\/merge-patch+json"]}}
     * @return \Symfony\Config\ApiPlatform\PatchFormatsConfig|$this
     * @psalm-return (TValue is array ? \Symfony\Config\ApiPlatform\PatchFormatsConfig : static)
     */
    public function patchFormats(string $format, array $value = []): \Symfony\Config\ApiPlatform\PatchFormatsConfig|static
    {
        if (!\is_array($value)) {
            $this->_usedProperties['patchFormats'] = true;
            $this->patchFormats[$format] = $value;

            return $this;
        }

        if (!isset($this->patchFormats[$format]) || !$this->patchFormats[$format] instanceof \Symfony\Config\ApiPlatform\PatchFormatsConfig) {
            $this->_usedProperties['patchFormats'] = true;
            $this->patchFormats[$format] = new \Symfony\Config\ApiPlatform\PatchFormatsConfig($value);
        } elseif (1 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "patchFormats()" has already been initialized. You cannot pass values the second time you call patchFormats().');
        }

        return $this->patchFormats[$format];
    }

    /**
     * @template TValue
     * @param TValue $value
     * The list of enabled formats. The first one will be the default.
     * @default {"jsonld":{"mime_types":["application\/ld+json"]},"jsonopenapi":{"mime_types":["application\/vnd.openapi+json"]},"html":{"mime_types":["text\/html"]},"yamlopenapi":{"mime_types":["application\/vnd.openapi+yaml"]}}
     * @return \Symfony\Config\ApiPlatform\DocsFormatsConfig|$this
     * @psalm-return (TValue is array ? \Symfony\Config\ApiPlatform\DocsFormatsConfig : static)
     */
    public function docsFormats(string $format, array $value = []): \Symfony\Config\ApiPlatform\DocsFormatsConfig|static
    {
        if (!\is_array($value)) {
            $this->_usedProperties['docsFormats'] = true;
            $this->docsFormats[$format] = $value;

            return $this;
        }

        if (!isset($this->docsFormats[$format]) || !$this->docsFormats[$format] instanceof \Symfony\Config\ApiPlatform\DocsFormatsConfig) {
            $this->_usedProperties['docsFormats'] = true;
            $this->docsFormats[$format] = new \Symfony\Config\ApiPlatform\DocsFormatsConfig($value);
        } elseif (1 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "docsFormats()" has already been initialized. You cannot pass values the second time you call docsFormats().');
        }

        return $this->docsFormats[$format];
    }

    /**
     * @template TValue
     * @param TValue $value
     * The list of enabled formats. The first one will be the default.
     * @default {"jsonld":{"mime_types":["application\/ld+json"]},"jsonproblem":{"mime_types":["application\/problem+json"]},"json":{"mime_types":["application\/problem+json","application\/json"]}}
     * @return \Symfony\Config\ApiPlatform\ErrorFormatsConfig|$this
     * @psalm-return (TValue is array ? \Symfony\Config\ApiPlatform\ErrorFormatsConfig : static)
     */
    public function errorFormats(string $format, array $value = []): \Symfony\Config\ApiPlatform\ErrorFormatsConfig|static
    {
        if (!\is_array($value)) {
            $this->_usedProperties['errorFormats'] = true;
            $this->errorFormats[$format] = $value;

            return $this;
        }

        if (!isset($this->errorFormats[$format]) || !$this->errorFormats[$format] instanceof \Symfony\Config\ApiPlatform\ErrorFormatsConfig) {
            $this->_usedProperties['errorFormats'] = true;
            $this->errorFormats[$format] = new \Symfony\Config\ApiPlatform\ErrorFormatsConfig($value);
        } elseif (1 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "errorFormats()" has already been initialized. You cannot pass values the second time you call errorFormats().');
        }

        return $this->errorFormats[$format];
    }

    /**
     * @param ParamConfigurator|list<ParamConfigurator|mixed> $value
     *
     * @return $this
     */
    public function jsonschemaFormats(ParamConfigurator|array $value): static
    {
        $this->_usedProperties['jsonschemaFormats'] = true;
        $this->jsonschemaFormats = $value;

        return $this;
    }

    /**
     * @template TValue
     * @param TValue $value
     * @return \Symfony\Config\ApiPlatform\DefaultsConfig|$this
     * @psalm-return (TValue is array ? \Symfony\Config\ApiPlatform\DefaultsConfig : static)
     */
    public function defaults(mixed $value = []): \Symfony\Config\ApiPlatform\DefaultsConfig|static
    {
        if (!\is_array($value)) {
            $this->_usedProperties['defaults'] = true;
            $this->defaults = $value;

            return $this;
        }

        if (!$this->defaults instanceof \Symfony\Config\ApiPlatform\DefaultsConfig) {
            $this->_usedProperties['defaults'] = true;
            $this->defaults = new \Symfony\Config\ApiPlatform\DefaultsConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "defaults()" has already been initialized. You cannot pass values the second time you call defaults().');
        }

        return $this->defaults;
    }

    public function getExtensionAlias(): string
    {
        return 'api_platform';
    }

    public function __construct(array $value = [])
    {
        if (array_key_exists('title', $value)) {
            $this->_usedProperties['title'] = true;
            $this->title = $value['title'];
            unset($value['title']);
        }

        if (array_key_exists('description', $value)) {
            $this->_usedProperties['description'] = true;
            $this->description = $value['description'];
            unset($value['description']);
        }

        if (array_key_exists('version', $value)) {
            $this->_usedProperties['version'] = true;
            $this->version = $value['version'];
            unset($value['version']);
        }

        if (array_key_exists('show_webby', $value)) {
            $this->_usedProperties['showWebby'] = true;
            $this->showWebby = $value['show_webby'];
            unset($value['show_webby']);
        }

        if (array_key_exists('use_symfony_listeners', $value)) {
            $this->_usedProperties['useSymfonyListeners'] = true;
            $this->useSymfonyListeners = $value['use_symfony_listeners'];
            unset($value['use_symfony_listeners']);
        }

        if (array_key_exists('name_converter', $value)) {
            $this->_usedProperties['nameConverter'] = true;
            $this->nameConverter = $value['name_converter'];
            unset($value['name_converter']);
        }

        if (array_key_exists('asset_package', $value)) {
            $this->_usedProperties['assetPackage'] = true;
            $this->assetPackage = $value['asset_package'];
            unset($value['asset_package']);
        }

        if (array_key_exists('path_segment_name_generator', $value)) {
            $this->_usedProperties['pathSegmentNameGenerator'] = true;
            $this->pathSegmentNameGenerator = $value['path_segment_name_generator'];
            unset($value['path_segment_name_generator']);
        }

        if (array_key_exists('inflector', $value)) {
            $this->_usedProperties['inflector'] = true;
            $this->inflector = $value['inflector'];
            unset($value['inflector']);
        }

        if (array_key_exists('validator', $value)) {
            $this->_usedProperties['validator'] = true;
            $this->validator = new \Symfony\Config\ApiPlatform\ValidatorConfig($value['validator']);
            unset($value['validator']);
        }

        if (array_key_exists('eager_loading', $value)) {
            $this->_usedProperties['eagerLoading'] = true;
            $this->eagerLoading = new \Symfony\Config\ApiPlatform\EagerLoadingConfig($value['eager_loading']);
            unset($value['eager_loading']);
        }

        if (array_key_exists('handle_symfony_errors', $value)) {
            $this->_usedProperties['handleSymfonyErrors'] = true;
            $this->handleSymfonyErrors = $value['handle_symfony_errors'];
            unset($value['handle_symfony_errors']);
        }

        if (array_key_exists('enable_swagger', $value)) {
            $this->_usedProperties['enableSwagger'] = true;
            $this->enableSwagger = $value['enable_swagger'];
            unset($value['enable_swagger']);
        }

        if (array_key_exists('enable_swagger_ui', $value)) {
            $this->_usedProperties['enableSwaggerUi'] = true;
            $this->enableSwaggerUi = $value['enable_swagger_ui'];
            unset($value['enable_swagger_ui']);
        }

        if (array_key_exists('enable_re_doc', $value)) {
            $this->_usedProperties['enableReDoc'] = true;
            $this->enableReDoc = $value['enable_re_doc'];
            unset($value['enable_re_doc']);
        }

        if (array_key_exists('enable_entrypoint', $value)) {
            $this->_usedProperties['enableEntrypoint'] = true;
            $this->enableEntrypoint = $value['enable_entrypoint'];
            unset($value['enable_entrypoint']);
        }

        if (array_key_exists('enable_docs', $value)) {
            $this->_usedProperties['enableDocs'] = true;
            $this->enableDocs = $value['enable_docs'];
            unset($value['enable_docs']);
        }

        if (array_key_exists('enable_profiler', $value)) {
            $this->_usedProperties['enableProfiler'] = true;
            $this->enableProfiler = $value['enable_profiler'];
            unset($value['enable_profiler']);
        }

        if (array_key_exists('enable_link_security', $value)) {
            $this->_usedProperties['enableLinkSecurity'] = true;
            $this->enableLinkSecurity = $value['enable_link_security'];
            unset($value['enable_link_security']);
        }

        if (array_key_exists('collection', $value)) {
            $this->_usedProperties['collection'] = true;
            $this->collection = new \Symfony\Config\ApiPlatform\CollectionConfig($value['collection']);
            unset($value['collection']);
        }

        if (array_key_exists('mapping', $value)) {
            $this->_usedProperties['mapping'] = true;
            $this->mapping = new \Symfony\Config\ApiPlatform\MappingConfig($value['mapping']);
            unset($value['mapping']);
        }

        if (array_key_exists('resource_class_directories', $value)) {
            $this->_usedProperties['resourceClassDirectories'] = true;
            $this->resourceClassDirectories = $value['resource_class_directories'];
            unset($value['resource_class_directories']);
        }

        if (array_key_exists('serializer', $value)) {
            $this->_usedProperties['serializer'] = true;
            $this->serializer = new \Symfony\Config\ApiPlatform\SerializerConfig($value['serializer']);
            unset($value['serializer']);
        }

        if (array_key_exists('doctrine', $value)) {
            $this->_usedProperties['doctrine'] = true;
            $this->doctrine = new \Symfony\Config\ApiPlatform\DoctrineConfig($value['doctrine']);
            unset($value['doctrine']);
        }

        if (array_key_exists('doctrine_mongodb_odm', $value)) {
            $this->_usedProperties['doctrineMongodbOdm'] = true;
            $this->doctrineMongodbOdm = \is_array($value['doctrine_mongodb_odm']) ? new \Symfony\Config\ApiPlatform\DoctrineMongodbOdmConfig($value['doctrine_mongodb_odm']) : $value['doctrine_mongodb_odm'];
            unset($value['doctrine_mongodb_odm']);
        }

        if (array_key_exists('oauth', $value)) {
            $this->_usedProperties['oauth'] = true;
            $this->oauth = \is_array($value['oauth']) ? new \Symfony\Config\ApiPlatform\OauthConfig($value['oauth']) : $value['oauth'];
            unset($value['oauth']);
        }

        if (array_key_exists('graphql', $value)) {
            $this->_usedProperties['graphql'] = true;
            $this->graphql = \is_array($value['graphql']) ? new \Symfony\Config\ApiPlatform\GraphqlConfig($value['graphql']) : $value['graphql'];
            unset($value['graphql']);
        }

        if (array_key_exists('swagger', $value)) {
            $this->_usedProperties['swagger'] = true;
            $this->swagger = new \Symfony\Config\ApiPlatform\SwaggerConfig($value['swagger']);
            unset($value['swagger']);
        }

        if (array_key_exists('http_cache', $value)) {
            $this->_usedProperties['httpCache'] = true;
            $this->httpCache = new \Symfony\Config\ApiPlatform\HttpCacheConfig($value['http_cache']);
            unset($value['http_cache']);
        }

        if (array_key_exists('mercure', $value)) {
            $this->_usedProperties['mercure'] = true;
            $this->mercure = \is_array($value['mercure']) ? new \Symfony\Config\ApiPlatform\MercureConfig($value['mercure']) : $value['mercure'];
            unset($value['mercure']);
        }

        if (array_key_exists('messenger', $value)) {
            $this->_usedProperties['messenger'] = true;
            $this->messenger = new \Symfony\Config\ApiPlatform\MessengerConfig($value['messenger']);
            unset($value['messenger']);
        }

        if (array_key_exists('elasticsearch', $value)) {
            $this->_usedProperties['elasticsearch'] = true;
            $this->elasticsearch = \is_array($value['elasticsearch']) ? new \Symfony\Config\ApiPlatform\ElasticsearchConfig($value['elasticsearch']) : $value['elasticsearch'];
            unset($value['elasticsearch']);
        }

        if (array_key_exists('openapi', $value)) {
            $this->_usedProperties['openapi'] = true;
            $this->openapi = new \Symfony\Config\ApiPlatform\OpenapiConfig($value['openapi']);
            unset($value['openapi']);
        }

        if (array_key_exists('maker', $value)) {
            $this->_usedProperties['maker'] = true;
            $this->maker = new \Symfony\Config\ApiPlatform\MakerConfig($value['maker']);
            unset($value['maker']);
        }

        if (array_key_exists('exception_to_status', $value)) {
            $this->_usedProperties['exceptionToStatus'] = true;
            $this->exceptionToStatus = $value['exception_to_status'];
            unset($value['exception_to_status']);
        }

        if (array_key_exists('formats', $value)) {
            $this->_usedProperties['formats'] = true;
            $this->formats = array_map(fn ($v) => \is_array($v) ? new \Symfony\Config\ApiPlatform\FormatsConfig($v) : $v, $value['formats']);
            unset($value['formats']);
        }

        if (array_key_exists('patch_formats', $value)) {
            $this->_usedProperties['patchFormats'] = true;
            $this->patchFormats = array_map(fn ($v) => \is_array($v) ? new \Symfony\Config\ApiPlatform\PatchFormatsConfig($v) : $v, $value['patch_formats']);
            unset($value['patch_formats']);
        }

        if (array_key_exists('docs_formats', $value)) {
            $this->_usedProperties['docsFormats'] = true;
            $this->docsFormats = array_map(fn ($v) => \is_array($v) ? new \Symfony\Config\ApiPlatform\DocsFormatsConfig($v) : $v, $value['docs_formats']);
            unset($value['docs_formats']);
        }

        if (array_key_exists('error_formats', $value)) {
            $this->_usedProperties['errorFormats'] = true;
            $this->errorFormats = array_map(fn ($v) => \is_array($v) ? new \Symfony\Config\ApiPlatform\ErrorFormatsConfig($v) : $v, $value['error_formats']);
            unset($value['error_formats']);
        }

        if (array_key_exists('jsonschema_formats', $value)) {
            $this->_usedProperties['jsonschemaFormats'] = true;
            $this->jsonschemaFormats = $value['jsonschema_formats'];
            unset($value['jsonschema_formats']);
        }

        if (array_key_exists('defaults', $value)) {
            $this->_usedProperties['defaults'] = true;
            $this->defaults = \is_array($value['defaults']) ? new \Symfony\Config\ApiPlatform\DefaultsConfig($value['defaults']) : $value['defaults'];
            unset($value['defaults']);
        }

        if ([] !== $value) {
            throw new InvalidConfigurationException(sprintf('The following keys are not supported by "%s": ', __CLASS__).implode(', ', array_keys($value)));
        }
    }

    public function toArray(): array
    {
        $output = [];
        if (isset($this->_usedProperties['title'])) {
            $output['title'] = $this->title;
        }
        if (isset($this->_usedProperties['description'])) {
            $output['description'] = $this->description;
        }
        if (isset($this->_usedProperties['version'])) {
            $output['version'] = $this->version;
        }
        if (isset($this->_usedProperties['showWebby'])) {
            $output['show_webby'] = $this->showWebby;
        }
        if (isset($this->_usedProperties['useSymfonyListeners'])) {
            $output['use_symfony_listeners'] = $this->useSymfonyListeners;
        }
        if (isset($this->_usedProperties['nameConverter'])) {
            $output['name_converter'] = $this->nameConverter;
        }
        if (isset($this->_usedProperties['assetPackage'])) {
            $output['asset_package'] = $this->assetPackage;
        }
        if (isset($this->_usedProperties['pathSegmentNameGenerator'])) {
            $output['path_segment_name_generator'] = $this->pathSegmentNameGenerator;
        }
        if (isset($this->_usedProperties['inflector'])) {
            $output['inflector'] = $this->inflector;
        }
        if (isset($this->_usedProperties['validator'])) {
            $output['validator'] = $this->validator->toArray();
        }
        if (isset($this->_usedProperties['eagerLoading'])) {
            $output['eager_loading'] = $this->eagerLoading->toArray();
        }
        if (isset($this->_usedProperties['handleSymfonyErrors'])) {
            $output['handle_symfony_errors'] = $this->handleSymfonyErrors;
        }
        if (isset($this->_usedProperties['enableSwagger'])) {
            $output['enable_swagger'] = $this->enableSwagger;
        }
        if (isset($this->_usedProperties['enableSwaggerUi'])) {
            $output['enable_swagger_ui'] = $this->enableSwaggerUi;
        }
        if (isset($this->_usedProperties['enableReDoc'])) {
            $output['enable_re_doc'] = $this->enableReDoc;
        }
        if (isset($this->_usedProperties['enableEntrypoint'])) {
            $output['enable_entrypoint'] = $this->enableEntrypoint;
        }
        if (isset($this->_usedProperties['enableDocs'])) {
            $output['enable_docs'] = $this->enableDocs;
        }
        if (isset($this->_usedProperties['enableProfiler'])) {
            $output['enable_profiler'] = $this->enableProfiler;
        }
        if (isset($this->_usedProperties['enableLinkSecurity'])) {
            $output['enable_link_security'] = $this->enableLinkSecurity;
        }
        if (isset($this->_usedProperties['collection'])) {
            $output['collection'] = $this->collection->toArray();
        }
        if (isset($this->_usedProperties['mapping'])) {
            $output['mapping'] = $this->mapping->toArray();
        }
        if (isset($this->_usedProperties['resourceClassDirectories'])) {
            $output['resource_class_directories'] = $this->resourceClassDirectories;
        }
        if (isset($this->_usedProperties['serializer'])) {
            $output['serializer'] = $this->serializer->toArray();
        }
        if (isset($this->_usedProperties['doctrine'])) {
            $output['doctrine'] = $this->doctrine->toArray();
        }
        if (isset($this->_usedProperties['doctrineMongodbOdm'])) {
            $output['doctrine_mongodb_odm'] = $this->doctrineMongodbOdm instanceof \Symfony\Config\ApiPlatform\DoctrineMongodbOdmConfig ? $this->doctrineMongodbOdm->toArray() : $this->doctrineMongodbOdm;
        }
        if (isset($this->_usedProperties['oauth'])) {
            $output['oauth'] = $this->oauth instanceof \Symfony\Config\ApiPlatform\OauthConfig ? $this->oauth->toArray() : $this->oauth;
        }
        if (isset($this->_usedProperties['graphql'])) {
            $output['graphql'] = $this->graphql instanceof \Symfony\Config\ApiPlatform\GraphqlConfig ? $this->graphql->toArray() : $this->graphql;
        }
        if (isset($this->_usedProperties['swagger'])) {
            $output['swagger'] = $this->swagger->toArray();
        }
        if (isset($this->_usedProperties['httpCache'])) {
            $output['http_cache'] = $this->httpCache->toArray();
        }
        if (isset($this->_usedProperties['mercure'])) {
            $output['mercure'] = $this->mercure instanceof \Symfony\Config\ApiPlatform\MercureConfig ? $this->mercure->toArray() : $this->mercure;
        }
        if (isset($this->_usedProperties['messenger'])) {
            $output['messenger'] = $this->messenger->toArray();
        }
        if (isset($this->_usedProperties['elasticsearch'])) {
            $output['elasticsearch'] = $this->elasticsearch instanceof \Symfony\Config\ApiPlatform\ElasticsearchConfig ? $this->elasticsearch->toArray() : $this->elasticsearch;
        }
        if (isset($this->_usedProperties['openapi'])) {
            $output['openapi'] = $this->openapi->toArray();
        }
        if (isset($this->_usedProperties['maker'])) {
            $output['maker'] = $this->maker->toArray();
        }
        if (isset($this->_usedProperties['exceptionToStatus'])) {
            $output['exception_to_status'] = $this->exceptionToStatus;
        }
        if (isset($this->_usedProperties['formats'])) {
            $output['formats'] = array_map(fn ($v) => $v instanceof \Symfony\Config\ApiPlatform\FormatsConfig ? $v->toArray() : $v, $this->formats);
        }
        if (isset($this->_usedProperties['patchFormats'])) {
            $output['patch_formats'] = array_map(fn ($v) => $v instanceof \Symfony\Config\ApiPlatform\PatchFormatsConfig ? $v->toArray() : $v, $this->patchFormats);
        }
        if (isset($this->_usedProperties['docsFormats'])) {
            $output['docs_formats'] = array_map(fn ($v) => $v instanceof \Symfony\Config\ApiPlatform\DocsFormatsConfig ? $v->toArray() : $v, $this->docsFormats);
        }
        if (isset($this->_usedProperties['errorFormats'])) {
            $output['error_formats'] = array_map(fn ($v) => $v instanceof \Symfony\Config\ApiPlatform\ErrorFormatsConfig ? $v->toArray() : $v, $this->errorFormats);
        }
        if (isset($this->_usedProperties['jsonschemaFormats'])) {
            $output['jsonschema_formats'] = $this->jsonschemaFormats;
        }
        if (isset($this->_usedProperties['defaults'])) {
            $output['defaults'] = $this->defaults instanceof \Symfony\Config\ApiPlatform\DefaultsConfig ? $this->defaults->toArray() : $this->defaults;
        }

        return $output;
    }

}
