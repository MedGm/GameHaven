<?php

namespace Symfony\Config\ApiPlatform;

use Symfony\Component\Config\Loader\ParamConfigurator;

/**
 * This class is automatically generated to help in creating a config.
 */
class DefaultsConfig 
{
    private $uriTemplate;
    private $shortName;
    private $description;
    private $types;
    private $operations;
    private $formats;
    private $inputFormats;
    private $outputFormats;
    private $uriVariables;
    private $routePrefix;
    private $defaults;
    private $requirements;
    private $options;
    private $stateless;
    private $sunset;
    private $acceptPatch;
    private $status;
    private $host;
    private $schemes;
    private $condition;
    private $controller;
    private $class;
    private $urlGenerationStrategy;
    private $deprecationReason;
    private $headers;
    private $cacheHeaders;
    private $normalizationContext;
    private $denormalizationContext;
    private $collectDenormalizationErrors;
    private $hydraContext;
    private $openapi;
    private $validationContext;
    private $filters;
    private $elasticsearch;
    private $mercure;
    private $messenger;
    private $input;
    private $output;
    private $order;
    private $fetchPartial;
    private $forceEager;
    private $paginationClientEnabled;
    private $paginationClientItemsPerPage;
    private $paginationClientPartial;
    private $paginationViaCursor;
    private $paginationEnabled;
    private $paginationFetchJoinCollection;
    private $paginationUseOutputWalkers;
    private $paginationItemsPerPage;
    private $paginationMaximumItemsPerPage;
    private $paginationPartial;
    private $paginationType;
    private $security;
    private $securityMessage;
    private $securityPostDenormalize;
    private $securityPostDenormalizeMessage;
    private $securityPostValidation;
    private $securityPostValidationMessage;
    private $compositeIdentifier;
    private $exceptionToStatus;
    private $queryParameterValidationEnabled;
    private $links;
    private $graphQlOperations;
    private $provider;
    private $processor;
    private $stateOptions;
    private $rules;
    private $policy;
    private $middleware;
    private $parameters;
    private $extraProperties;
    private $routeName;
    private $errors;
    private $read;
    private $deserialize;
    private $validate;
    private $write;
    private $serialize;
    private $priority;
    private $name;
    private $allowCreate;
    private $itemUriTemplate;
    private $_usedProperties = [];
    private $_extraKeys;

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function uriTemplate(mixed $value): static
    {
        $this->_usedProperties['uriTemplate'] = true;
        $this->uriTemplate = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function shortName(mixed $value): static
    {
        $this->_usedProperties['shortName'] = true;
        $this->shortName = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function description(mixed $value): static
    {
        $this->_usedProperties['description'] = true;
        $this->description = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function types(mixed $value): static
    {
        $this->_usedProperties['types'] = true;
        $this->types = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function operations(mixed $value): static
    {
        $this->_usedProperties['operations'] = true;
        $this->operations = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function formats(mixed $value): static
    {
        $this->_usedProperties['formats'] = true;
        $this->formats = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function inputFormats(mixed $value): static
    {
        $this->_usedProperties['inputFormats'] = true;
        $this->inputFormats = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function outputFormats(mixed $value): static
    {
        $this->_usedProperties['outputFormats'] = true;
        $this->outputFormats = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function uriVariables(mixed $value): static
    {
        $this->_usedProperties['uriVariables'] = true;
        $this->uriVariables = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function routePrefix(mixed $value): static
    {
        $this->_usedProperties['routePrefix'] = true;
        $this->routePrefix = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function defaults(mixed $value): static
    {
        $this->_usedProperties['defaults'] = true;
        $this->defaults = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function requirements(mixed $value): static
    {
        $this->_usedProperties['requirements'] = true;
        $this->requirements = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function options(mixed $value): static
    {
        $this->_usedProperties['options'] = true;
        $this->options = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function stateless(mixed $value): static
    {
        $this->_usedProperties['stateless'] = true;
        $this->stateless = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function sunset(mixed $value): static
    {
        $this->_usedProperties['sunset'] = true;
        $this->sunset = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function acceptPatch(mixed $value): static
    {
        $this->_usedProperties['acceptPatch'] = true;
        $this->acceptPatch = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function status(mixed $value): static
    {
        $this->_usedProperties['status'] = true;
        $this->status = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function host(mixed $value): static
    {
        $this->_usedProperties['host'] = true;
        $this->host = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function schemes(mixed $value): static
    {
        $this->_usedProperties['schemes'] = true;
        $this->schemes = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function condition(mixed $value): static
    {
        $this->_usedProperties['condition'] = true;
        $this->condition = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function controller(mixed $value): static
    {
        $this->_usedProperties['controller'] = true;
        $this->controller = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function class(mixed $value): static
    {
        $this->_usedProperties['class'] = true;
        $this->class = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function urlGenerationStrategy(mixed $value): static
    {
        $this->_usedProperties['urlGenerationStrategy'] = true;
        $this->urlGenerationStrategy = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function deprecationReason(mixed $value): static
    {
        $this->_usedProperties['deprecationReason'] = true;
        $this->deprecationReason = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function headers(mixed $value): static
    {
        $this->_usedProperties['headers'] = true;
        $this->headers = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function cacheHeaders(mixed $value): static
    {
        $this->_usedProperties['cacheHeaders'] = true;
        $this->cacheHeaders = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function normalizationContext(mixed $value): static
    {
        $this->_usedProperties['normalizationContext'] = true;
        $this->normalizationContext = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function denormalizationContext(mixed $value): static
    {
        $this->_usedProperties['denormalizationContext'] = true;
        $this->denormalizationContext = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function collectDenormalizationErrors(mixed $value): static
    {
        $this->_usedProperties['collectDenormalizationErrors'] = true;
        $this->collectDenormalizationErrors = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function hydraContext(mixed $value): static
    {
        $this->_usedProperties['hydraContext'] = true;
        $this->hydraContext = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function openapi(mixed $value): static
    {
        $this->_usedProperties['openapi'] = true;
        $this->openapi = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function validationContext(mixed $value): static
    {
        $this->_usedProperties['validationContext'] = true;
        $this->validationContext = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function filters(mixed $value): static
    {
        $this->_usedProperties['filters'] = true;
        $this->filters = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function elasticsearch(mixed $value): static
    {
        $this->_usedProperties['elasticsearch'] = true;
        $this->elasticsearch = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function mercure(mixed $value): static
    {
        $this->_usedProperties['mercure'] = true;
        $this->mercure = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function messenger(mixed $value): static
    {
        $this->_usedProperties['messenger'] = true;
        $this->messenger = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function input(mixed $value): static
    {
        $this->_usedProperties['input'] = true;
        $this->input = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function output(mixed $value): static
    {
        $this->_usedProperties['output'] = true;
        $this->output = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function order(mixed $value): static
    {
        $this->_usedProperties['order'] = true;
        $this->order = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function fetchPartial(mixed $value): static
    {
        $this->_usedProperties['fetchPartial'] = true;
        $this->fetchPartial = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function forceEager(mixed $value): static
    {
        $this->_usedProperties['forceEager'] = true;
        $this->forceEager = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function paginationClientEnabled(mixed $value): static
    {
        $this->_usedProperties['paginationClientEnabled'] = true;
        $this->paginationClientEnabled = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function paginationClientItemsPerPage(mixed $value): static
    {
        $this->_usedProperties['paginationClientItemsPerPage'] = true;
        $this->paginationClientItemsPerPage = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function paginationClientPartial(mixed $value): static
    {
        $this->_usedProperties['paginationClientPartial'] = true;
        $this->paginationClientPartial = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function paginationViaCursor(mixed $value): static
    {
        $this->_usedProperties['paginationViaCursor'] = true;
        $this->paginationViaCursor = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function paginationEnabled(mixed $value): static
    {
        $this->_usedProperties['paginationEnabled'] = true;
        $this->paginationEnabled = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function paginationFetchJoinCollection(mixed $value): static
    {
        $this->_usedProperties['paginationFetchJoinCollection'] = true;
        $this->paginationFetchJoinCollection = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function paginationUseOutputWalkers(mixed $value): static
    {
        $this->_usedProperties['paginationUseOutputWalkers'] = true;
        $this->paginationUseOutputWalkers = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function paginationItemsPerPage(mixed $value): static
    {
        $this->_usedProperties['paginationItemsPerPage'] = true;
        $this->paginationItemsPerPage = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function paginationMaximumItemsPerPage(mixed $value): static
    {
        $this->_usedProperties['paginationMaximumItemsPerPage'] = true;
        $this->paginationMaximumItemsPerPage = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function paginationPartial(mixed $value): static
    {
        $this->_usedProperties['paginationPartial'] = true;
        $this->paginationPartial = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function paginationType(mixed $value): static
    {
        $this->_usedProperties['paginationType'] = true;
        $this->paginationType = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function security(mixed $value): static
    {
        $this->_usedProperties['security'] = true;
        $this->security = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function securityMessage(mixed $value): static
    {
        $this->_usedProperties['securityMessage'] = true;
        $this->securityMessage = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function securityPostDenormalize(mixed $value): static
    {
        $this->_usedProperties['securityPostDenormalize'] = true;
        $this->securityPostDenormalize = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function securityPostDenormalizeMessage(mixed $value): static
    {
        $this->_usedProperties['securityPostDenormalizeMessage'] = true;
        $this->securityPostDenormalizeMessage = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function securityPostValidation(mixed $value): static
    {
        $this->_usedProperties['securityPostValidation'] = true;
        $this->securityPostValidation = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function securityPostValidationMessage(mixed $value): static
    {
        $this->_usedProperties['securityPostValidationMessage'] = true;
        $this->securityPostValidationMessage = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function compositeIdentifier(mixed $value): static
    {
        $this->_usedProperties['compositeIdentifier'] = true;
        $this->compositeIdentifier = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function exceptionToStatus(mixed $value): static
    {
        $this->_usedProperties['exceptionToStatus'] = true;
        $this->exceptionToStatus = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function queryParameterValidationEnabled(mixed $value): static
    {
        $this->_usedProperties['queryParameterValidationEnabled'] = true;
        $this->queryParameterValidationEnabled = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function links(mixed $value): static
    {
        $this->_usedProperties['links'] = true;
        $this->links = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function graphQlOperations(mixed $value): static
    {
        $this->_usedProperties['graphQlOperations'] = true;
        $this->graphQlOperations = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function provider(mixed $value): static
    {
        $this->_usedProperties['provider'] = true;
        $this->provider = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function processor(mixed $value): static
    {
        $this->_usedProperties['processor'] = true;
        $this->processor = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function stateOptions(mixed $value): static
    {
        $this->_usedProperties['stateOptions'] = true;
        $this->stateOptions = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function rules(mixed $value): static
    {
        $this->_usedProperties['rules'] = true;
        $this->rules = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function policy(mixed $value): static
    {
        $this->_usedProperties['policy'] = true;
        $this->policy = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function middleware(mixed $value): static
    {
        $this->_usedProperties['middleware'] = true;
        $this->middleware = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function parameters(mixed $value): static
    {
        $this->_usedProperties['parameters'] = true;
        $this->parameters = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function extraProperties(mixed $value): static
    {
        $this->_usedProperties['extraProperties'] = true;
        $this->extraProperties = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function routeName(mixed $value): static
    {
        $this->_usedProperties['routeName'] = true;
        $this->routeName = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function errors(mixed $value): static
    {
        $this->_usedProperties['errors'] = true;
        $this->errors = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function read(mixed $value): static
    {
        $this->_usedProperties['read'] = true;
        $this->read = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function deserialize(mixed $value): static
    {
        $this->_usedProperties['deserialize'] = true;
        $this->deserialize = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function validate(mixed $value): static
    {
        $this->_usedProperties['validate'] = true;
        $this->validate = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function write(mixed $value): static
    {
        $this->_usedProperties['write'] = true;
        $this->write = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function serialize(mixed $value): static
    {
        $this->_usedProperties['serialize'] = true;
        $this->serialize = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function priority(mixed $value): static
    {
        $this->_usedProperties['priority'] = true;
        $this->priority = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function name(mixed $value): static
    {
        $this->_usedProperties['name'] = true;
        $this->name = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function allowCreate(mixed $value): static
    {
        $this->_usedProperties['allowCreate'] = true;
        $this->allowCreate = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function itemUriTemplate(mixed $value): static
    {
        $this->_usedProperties['itemUriTemplate'] = true;
        $this->itemUriTemplate = $value;

        return $this;
    }

    public function __construct(array $value = [])
    {
        if (array_key_exists('uri_template', $value)) {
            $this->_usedProperties['uriTemplate'] = true;
            $this->uriTemplate = $value['uri_template'];
            unset($value['uri_template']);
        }

        if (array_key_exists('short_name', $value)) {
            $this->_usedProperties['shortName'] = true;
            $this->shortName = $value['short_name'];
            unset($value['short_name']);
        }

        if (array_key_exists('description', $value)) {
            $this->_usedProperties['description'] = true;
            $this->description = $value['description'];
            unset($value['description']);
        }

        if (array_key_exists('types', $value)) {
            $this->_usedProperties['types'] = true;
            $this->types = $value['types'];
            unset($value['types']);
        }

        if (array_key_exists('operations', $value)) {
            $this->_usedProperties['operations'] = true;
            $this->operations = $value['operations'];
            unset($value['operations']);
        }

        if (array_key_exists('formats', $value)) {
            $this->_usedProperties['formats'] = true;
            $this->formats = $value['formats'];
            unset($value['formats']);
        }

        if (array_key_exists('input_formats', $value)) {
            $this->_usedProperties['inputFormats'] = true;
            $this->inputFormats = $value['input_formats'];
            unset($value['input_formats']);
        }

        if (array_key_exists('output_formats', $value)) {
            $this->_usedProperties['outputFormats'] = true;
            $this->outputFormats = $value['output_formats'];
            unset($value['output_formats']);
        }

        if (array_key_exists('uri_variables', $value)) {
            $this->_usedProperties['uriVariables'] = true;
            $this->uriVariables = $value['uri_variables'];
            unset($value['uri_variables']);
        }

        if (array_key_exists('route_prefix', $value)) {
            $this->_usedProperties['routePrefix'] = true;
            $this->routePrefix = $value['route_prefix'];
            unset($value['route_prefix']);
        }

        if (array_key_exists('defaults', $value)) {
            $this->_usedProperties['defaults'] = true;
            $this->defaults = $value['defaults'];
            unset($value['defaults']);
        }

        if (array_key_exists('requirements', $value)) {
            $this->_usedProperties['requirements'] = true;
            $this->requirements = $value['requirements'];
            unset($value['requirements']);
        }

        if (array_key_exists('options', $value)) {
            $this->_usedProperties['options'] = true;
            $this->options = $value['options'];
            unset($value['options']);
        }

        if (array_key_exists('stateless', $value)) {
            $this->_usedProperties['stateless'] = true;
            $this->stateless = $value['stateless'];
            unset($value['stateless']);
        }

        if (array_key_exists('sunset', $value)) {
            $this->_usedProperties['sunset'] = true;
            $this->sunset = $value['sunset'];
            unset($value['sunset']);
        }

        if (array_key_exists('accept_patch', $value)) {
            $this->_usedProperties['acceptPatch'] = true;
            $this->acceptPatch = $value['accept_patch'];
            unset($value['accept_patch']);
        }

        if (array_key_exists('status', $value)) {
            $this->_usedProperties['status'] = true;
            $this->status = $value['status'];
            unset($value['status']);
        }

        if (array_key_exists('host', $value)) {
            $this->_usedProperties['host'] = true;
            $this->host = $value['host'];
            unset($value['host']);
        }

        if (array_key_exists('schemes', $value)) {
            $this->_usedProperties['schemes'] = true;
            $this->schemes = $value['schemes'];
            unset($value['schemes']);
        }

        if (array_key_exists('condition', $value)) {
            $this->_usedProperties['condition'] = true;
            $this->condition = $value['condition'];
            unset($value['condition']);
        }

        if (array_key_exists('controller', $value)) {
            $this->_usedProperties['controller'] = true;
            $this->controller = $value['controller'];
            unset($value['controller']);
        }

        if (array_key_exists('class', $value)) {
            $this->_usedProperties['class'] = true;
            $this->class = $value['class'];
            unset($value['class']);
        }

        if (array_key_exists('url_generation_strategy', $value)) {
            $this->_usedProperties['urlGenerationStrategy'] = true;
            $this->urlGenerationStrategy = $value['url_generation_strategy'];
            unset($value['url_generation_strategy']);
        }

        if (array_key_exists('deprecation_reason', $value)) {
            $this->_usedProperties['deprecationReason'] = true;
            $this->deprecationReason = $value['deprecation_reason'];
            unset($value['deprecation_reason']);
        }

        if (array_key_exists('headers', $value)) {
            $this->_usedProperties['headers'] = true;
            $this->headers = $value['headers'];
            unset($value['headers']);
        }

        if (array_key_exists('cache_headers', $value)) {
            $this->_usedProperties['cacheHeaders'] = true;
            $this->cacheHeaders = $value['cache_headers'];
            unset($value['cache_headers']);
        }

        if (array_key_exists('normalization_context', $value)) {
            $this->_usedProperties['normalizationContext'] = true;
            $this->normalizationContext = $value['normalization_context'];
            unset($value['normalization_context']);
        }

        if (array_key_exists('denormalization_context', $value)) {
            $this->_usedProperties['denormalizationContext'] = true;
            $this->denormalizationContext = $value['denormalization_context'];
            unset($value['denormalization_context']);
        }

        if (array_key_exists('collect_denormalization_errors', $value)) {
            $this->_usedProperties['collectDenormalizationErrors'] = true;
            $this->collectDenormalizationErrors = $value['collect_denormalization_errors'];
            unset($value['collect_denormalization_errors']);
        }

        if (array_key_exists('hydra_context', $value)) {
            $this->_usedProperties['hydraContext'] = true;
            $this->hydraContext = $value['hydra_context'];
            unset($value['hydra_context']);
        }

        if (array_key_exists('openapi', $value)) {
            $this->_usedProperties['openapi'] = true;
            $this->openapi = $value['openapi'];
            unset($value['openapi']);
        }

        if (array_key_exists('validation_context', $value)) {
            $this->_usedProperties['validationContext'] = true;
            $this->validationContext = $value['validation_context'];
            unset($value['validation_context']);
        }

        if (array_key_exists('filters', $value)) {
            $this->_usedProperties['filters'] = true;
            $this->filters = $value['filters'];
            unset($value['filters']);
        }

        if (array_key_exists('elasticsearch', $value)) {
            $this->_usedProperties['elasticsearch'] = true;
            $this->elasticsearch = $value['elasticsearch'];
            unset($value['elasticsearch']);
        }

        if (array_key_exists('mercure', $value)) {
            $this->_usedProperties['mercure'] = true;
            $this->mercure = $value['mercure'];
            unset($value['mercure']);
        }

        if (array_key_exists('messenger', $value)) {
            $this->_usedProperties['messenger'] = true;
            $this->messenger = $value['messenger'];
            unset($value['messenger']);
        }

        if (array_key_exists('input', $value)) {
            $this->_usedProperties['input'] = true;
            $this->input = $value['input'];
            unset($value['input']);
        }

        if (array_key_exists('output', $value)) {
            $this->_usedProperties['output'] = true;
            $this->output = $value['output'];
            unset($value['output']);
        }

        if (array_key_exists('order', $value)) {
            $this->_usedProperties['order'] = true;
            $this->order = $value['order'];
            unset($value['order']);
        }

        if (array_key_exists('fetch_partial', $value)) {
            $this->_usedProperties['fetchPartial'] = true;
            $this->fetchPartial = $value['fetch_partial'];
            unset($value['fetch_partial']);
        }

        if (array_key_exists('force_eager', $value)) {
            $this->_usedProperties['forceEager'] = true;
            $this->forceEager = $value['force_eager'];
            unset($value['force_eager']);
        }

        if (array_key_exists('pagination_client_enabled', $value)) {
            $this->_usedProperties['paginationClientEnabled'] = true;
            $this->paginationClientEnabled = $value['pagination_client_enabled'];
            unset($value['pagination_client_enabled']);
        }

        if (array_key_exists('pagination_client_items_per_page', $value)) {
            $this->_usedProperties['paginationClientItemsPerPage'] = true;
            $this->paginationClientItemsPerPage = $value['pagination_client_items_per_page'];
            unset($value['pagination_client_items_per_page']);
        }

        if (array_key_exists('pagination_client_partial', $value)) {
            $this->_usedProperties['paginationClientPartial'] = true;
            $this->paginationClientPartial = $value['pagination_client_partial'];
            unset($value['pagination_client_partial']);
        }

        if (array_key_exists('pagination_via_cursor', $value)) {
            $this->_usedProperties['paginationViaCursor'] = true;
            $this->paginationViaCursor = $value['pagination_via_cursor'];
            unset($value['pagination_via_cursor']);
        }

        if (array_key_exists('pagination_enabled', $value)) {
            $this->_usedProperties['paginationEnabled'] = true;
            $this->paginationEnabled = $value['pagination_enabled'];
            unset($value['pagination_enabled']);
        }

        if (array_key_exists('pagination_fetch_join_collection', $value)) {
            $this->_usedProperties['paginationFetchJoinCollection'] = true;
            $this->paginationFetchJoinCollection = $value['pagination_fetch_join_collection'];
            unset($value['pagination_fetch_join_collection']);
        }

        if (array_key_exists('pagination_use_output_walkers', $value)) {
            $this->_usedProperties['paginationUseOutputWalkers'] = true;
            $this->paginationUseOutputWalkers = $value['pagination_use_output_walkers'];
            unset($value['pagination_use_output_walkers']);
        }

        if (array_key_exists('pagination_items_per_page', $value)) {
            $this->_usedProperties['paginationItemsPerPage'] = true;
            $this->paginationItemsPerPage = $value['pagination_items_per_page'];
            unset($value['pagination_items_per_page']);
        }

        if (array_key_exists('pagination_maximum_items_per_page', $value)) {
            $this->_usedProperties['paginationMaximumItemsPerPage'] = true;
            $this->paginationMaximumItemsPerPage = $value['pagination_maximum_items_per_page'];
            unset($value['pagination_maximum_items_per_page']);
        }

        if (array_key_exists('pagination_partial', $value)) {
            $this->_usedProperties['paginationPartial'] = true;
            $this->paginationPartial = $value['pagination_partial'];
            unset($value['pagination_partial']);
        }

        if (array_key_exists('pagination_type', $value)) {
            $this->_usedProperties['paginationType'] = true;
            $this->paginationType = $value['pagination_type'];
            unset($value['pagination_type']);
        }

        if (array_key_exists('security', $value)) {
            $this->_usedProperties['security'] = true;
            $this->security = $value['security'];
            unset($value['security']);
        }

        if (array_key_exists('security_message', $value)) {
            $this->_usedProperties['securityMessage'] = true;
            $this->securityMessage = $value['security_message'];
            unset($value['security_message']);
        }

        if (array_key_exists('security_post_denormalize', $value)) {
            $this->_usedProperties['securityPostDenormalize'] = true;
            $this->securityPostDenormalize = $value['security_post_denormalize'];
            unset($value['security_post_denormalize']);
        }

        if (array_key_exists('security_post_denormalize_message', $value)) {
            $this->_usedProperties['securityPostDenormalizeMessage'] = true;
            $this->securityPostDenormalizeMessage = $value['security_post_denormalize_message'];
            unset($value['security_post_denormalize_message']);
        }

        if (array_key_exists('security_post_validation', $value)) {
            $this->_usedProperties['securityPostValidation'] = true;
            $this->securityPostValidation = $value['security_post_validation'];
            unset($value['security_post_validation']);
        }

        if (array_key_exists('security_post_validation_message', $value)) {
            $this->_usedProperties['securityPostValidationMessage'] = true;
            $this->securityPostValidationMessage = $value['security_post_validation_message'];
            unset($value['security_post_validation_message']);
        }

        if (array_key_exists('composite_identifier', $value)) {
            $this->_usedProperties['compositeIdentifier'] = true;
            $this->compositeIdentifier = $value['composite_identifier'];
            unset($value['composite_identifier']);
        }

        if (array_key_exists('exception_to_status', $value)) {
            $this->_usedProperties['exceptionToStatus'] = true;
            $this->exceptionToStatus = $value['exception_to_status'];
            unset($value['exception_to_status']);
        }

        if (array_key_exists('query_parameter_validation_enabled', $value)) {
            $this->_usedProperties['queryParameterValidationEnabled'] = true;
            $this->queryParameterValidationEnabled = $value['query_parameter_validation_enabled'];
            unset($value['query_parameter_validation_enabled']);
        }

        if (array_key_exists('links', $value)) {
            $this->_usedProperties['links'] = true;
            $this->links = $value['links'];
            unset($value['links']);
        }

        if (array_key_exists('graph_ql_operations', $value)) {
            $this->_usedProperties['graphQlOperations'] = true;
            $this->graphQlOperations = $value['graph_ql_operations'];
            unset($value['graph_ql_operations']);
        }

        if (array_key_exists('provider', $value)) {
            $this->_usedProperties['provider'] = true;
            $this->provider = $value['provider'];
            unset($value['provider']);
        }

        if (array_key_exists('processor', $value)) {
            $this->_usedProperties['processor'] = true;
            $this->processor = $value['processor'];
            unset($value['processor']);
        }

        if (array_key_exists('state_options', $value)) {
            $this->_usedProperties['stateOptions'] = true;
            $this->stateOptions = $value['state_options'];
            unset($value['state_options']);
        }

        if (array_key_exists('rules', $value)) {
            $this->_usedProperties['rules'] = true;
            $this->rules = $value['rules'];
            unset($value['rules']);
        }

        if (array_key_exists('policy', $value)) {
            $this->_usedProperties['policy'] = true;
            $this->policy = $value['policy'];
            unset($value['policy']);
        }

        if (array_key_exists('middleware', $value)) {
            $this->_usedProperties['middleware'] = true;
            $this->middleware = $value['middleware'];
            unset($value['middleware']);
        }

        if (array_key_exists('parameters', $value)) {
            $this->_usedProperties['parameters'] = true;
            $this->parameters = $value['parameters'];
            unset($value['parameters']);
        }

        if (array_key_exists('extra_properties', $value)) {
            $this->_usedProperties['extraProperties'] = true;
            $this->extraProperties = $value['extra_properties'];
            unset($value['extra_properties']);
        }

        if (array_key_exists('route_name', $value)) {
            $this->_usedProperties['routeName'] = true;
            $this->routeName = $value['route_name'];
            unset($value['route_name']);
        }

        if (array_key_exists('errors', $value)) {
            $this->_usedProperties['errors'] = true;
            $this->errors = $value['errors'];
            unset($value['errors']);
        }

        if (array_key_exists('read', $value)) {
            $this->_usedProperties['read'] = true;
            $this->read = $value['read'];
            unset($value['read']);
        }

        if (array_key_exists('deserialize', $value)) {
            $this->_usedProperties['deserialize'] = true;
            $this->deserialize = $value['deserialize'];
            unset($value['deserialize']);
        }

        if (array_key_exists('validate', $value)) {
            $this->_usedProperties['validate'] = true;
            $this->validate = $value['validate'];
            unset($value['validate']);
        }

        if (array_key_exists('write', $value)) {
            $this->_usedProperties['write'] = true;
            $this->write = $value['write'];
            unset($value['write']);
        }

        if (array_key_exists('serialize', $value)) {
            $this->_usedProperties['serialize'] = true;
            $this->serialize = $value['serialize'];
            unset($value['serialize']);
        }

        if (array_key_exists('priority', $value)) {
            $this->_usedProperties['priority'] = true;
            $this->priority = $value['priority'];
            unset($value['priority']);
        }

        if (array_key_exists('name', $value)) {
            $this->_usedProperties['name'] = true;
            $this->name = $value['name'];
            unset($value['name']);
        }

        if (array_key_exists('allow_create', $value)) {
            $this->_usedProperties['allowCreate'] = true;
            $this->allowCreate = $value['allow_create'];
            unset($value['allow_create']);
        }

        if (array_key_exists('item_uri_template', $value)) {
            $this->_usedProperties['itemUriTemplate'] = true;
            $this->itemUriTemplate = $value['item_uri_template'];
            unset($value['item_uri_template']);
        }

        $this->_extraKeys = $value;

    }

    public function toArray(): array
    {
        $output = [];
        if (isset($this->_usedProperties['uriTemplate'])) {
            $output['uri_template'] = $this->uriTemplate;
        }
        if (isset($this->_usedProperties['shortName'])) {
            $output['short_name'] = $this->shortName;
        }
        if (isset($this->_usedProperties['description'])) {
            $output['description'] = $this->description;
        }
        if (isset($this->_usedProperties['types'])) {
            $output['types'] = $this->types;
        }
        if (isset($this->_usedProperties['operations'])) {
            $output['operations'] = $this->operations;
        }
        if (isset($this->_usedProperties['formats'])) {
            $output['formats'] = $this->formats;
        }
        if (isset($this->_usedProperties['inputFormats'])) {
            $output['input_formats'] = $this->inputFormats;
        }
        if (isset($this->_usedProperties['outputFormats'])) {
            $output['output_formats'] = $this->outputFormats;
        }
        if (isset($this->_usedProperties['uriVariables'])) {
            $output['uri_variables'] = $this->uriVariables;
        }
        if (isset($this->_usedProperties['routePrefix'])) {
            $output['route_prefix'] = $this->routePrefix;
        }
        if (isset($this->_usedProperties['defaults'])) {
            $output['defaults'] = $this->defaults;
        }
        if (isset($this->_usedProperties['requirements'])) {
            $output['requirements'] = $this->requirements;
        }
        if (isset($this->_usedProperties['options'])) {
            $output['options'] = $this->options;
        }
        if (isset($this->_usedProperties['stateless'])) {
            $output['stateless'] = $this->stateless;
        }
        if (isset($this->_usedProperties['sunset'])) {
            $output['sunset'] = $this->sunset;
        }
        if (isset($this->_usedProperties['acceptPatch'])) {
            $output['accept_patch'] = $this->acceptPatch;
        }
        if (isset($this->_usedProperties['status'])) {
            $output['status'] = $this->status;
        }
        if (isset($this->_usedProperties['host'])) {
            $output['host'] = $this->host;
        }
        if (isset($this->_usedProperties['schemes'])) {
            $output['schemes'] = $this->schemes;
        }
        if (isset($this->_usedProperties['condition'])) {
            $output['condition'] = $this->condition;
        }
        if (isset($this->_usedProperties['controller'])) {
            $output['controller'] = $this->controller;
        }
        if (isset($this->_usedProperties['class'])) {
            $output['class'] = $this->class;
        }
        if (isset($this->_usedProperties['urlGenerationStrategy'])) {
            $output['url_generation_strategy'] = $this->urlGenerationStrategy;
        }
        if (isset($this->_usedProperties['deprecationReason'])) {
            $output['deprecation_reason'] = $this->deprecationReason;
        }
        if (isset($this->_usedProperties['headers'])) {
            $output['headers'] = $this->headers;
        }
        if (isset($this->_usedProperties['cacheHeaders'])) {
            $output['cache_headers'] = $this->cacheHeaders;
        }
        if (isset($this->_usedProperties['normalizationContext'])) {
            $output['normalization_context'] = $this->normalizationContext;
        }
        if (isset($this->_usedProperties['denormalizationContext'])) {
            $output['denormalization_context'] = $this->denormalizationContext;
        }
        if (isset($this->_usedProperties['collectDenormalizationErrors'])) {
            $output['collect_denormalization_errors'] = $this->collectDenormalizationErrors;
        }
        if (isset($this->_usedProperties['hydraContext'])) {
            $output['hydra_context'] = $this->hydraContext;
        }
        if (isset($this->_usedProperties['openapi'])) {
            $output['openapi'] = $this->openapi;
        }
        if (isset($this->_usedProperties['validationContext'])) {
            $output['validation_context'] = $this->validationContext;
        }
        if (isset($this->_usedProperties['filters'])) {
            $output['filters'] = $this->filters;
        }
        if (isset($this->_usedProperties['elasticsearch'])) {
            $output['elasticsearch'] = $this->elasticsearch;
        }
        if (isset($this->_usedProperties['mercure'])) {
            $output['mercure'] = $this->mercure;
        }
        if (isset($this->_usedProperties['messenger'])) {
            $output['messenger'] = $this->messenger;
        }
        if (isset($this->_usedProperties['input'])) {
            $output['input'] = $this->input;
        }
        if (isset($this->_usedProperties['output'])) {
            $output['output'] = $this->output;
        }
        if (isset($this->_usedProperties['order'])) {
            $output['order'] = $this->order;
        }
        if (isset($this->_usedProperties['fetchPartial'])) {
            $output['fetch_partial'] = $this->fetchPartial;
        }
        if (isset($this->_usedProperties['forceEager'])) {
            $output['force_eager'] = $this->forceEager;
        }
        if (isset($this->_usedProperties['paginationClientEnabled'])) {
            $output['pagination_client_enabled'] = $this->paginationClientEnabled;
        }
        if (isset($this->_usedProperties['paginationClientItemsPerPage'])) {
            $output['pagination_client_items_per_page'] = $this->paginationClientItemsPerPage;
        }
        if (isset($this->_usedProperties['paginationClientPartial'])) {
            $output['pagination_client_partial'] = $this->paginationClientPartial;
        }
        if (isset($this->_usedProperties['paginationViaCursor'])) {
            $output['pagination_via_cursor'] = $this->paginationViaCursor;
        }
        if (isset($this->_usedProperties['paginationEnabled'])) {
            $output['pagination_enabled'] = $this->paginationEnabled;
        }
        if (isset($this->_usedProperties['paginationFetchJoinCollection'])) {
            $output['pagination_fetch_join_collection'] = $this->paginationFetchJoinCollection;
        }
        if (isset($this->_usedProperties['paginationUseOutputWalkers'])) {
            $output['pagination_use_output_walkers'] = $this->paginationUseOutputWalkers;
        }
        if (isset($this->_usedProperties['paginationItemsPerPage'])) {
            $output['pagination_items_per_page'] = $this->paginationItemsPerPage;
        }
        if (isset($this->_usedProperties['paginationMaximumItemsPerPage'])) {
            $output['pagination_maximum_items_per_page'] = $this->paginationMaximumItemsPerPage;
        }
        if (isset($this->_usedProperties['paginationPartial'])) {
            $output['pagination_partial'] = $this->paginationPartial;
        }
        if (isset($this->_usedProperties['paginationType'])) {
            $output['pagination_type'] = $this->paginationType;
        }
        if (isset($this->_usedProperties['security'])) {
            $output['security'] = $this->security;
        }
        if (isset($this->_usedProperties['securityMessage'])) {
            $output['security_message'] = $this->securityMessage;
        }
        if (isset($this->_usedProperties['securityPostDenormalize'])) {
            $output['security_post_denormalize'] = $this->securityPostDenormalize;
        }
        if (isset($this->_usedProperties['securityPostDenormalizeMessage'])) {
            $output['security_post_denormalize_message'] = $this->securityPostDenormalizeMessage;
        }
        if (isset($this->_usedProperties['securityPostValidation'])) {
            $output['security_post_validation'] = $this->securityPostValidation;
        }
        if (isset($this->_usedProperties['securityPostValidationMessage'])) {
            $output['security_post_validation_message'] = $this->securityPostValidationMessage;
        }
        if (isset($this->_usedProperties['compositeIdentifier'])) {
            $output['composite_identifier'] = $this->compositeIdentifier;
        }
        if (isset($this->_usedProperties['exceptionToStatus'])) {
            $output['exception_to_status'] = $this->exceptionToStatus;
        }
        if (isset($this->_usedProperties['queryParameterValidationEnabled'])) {
            $output['query_parameter_validation_enabled'] = $this->queryParameterValidationEnabled;
        }
        if (isset($this->_usedProperties['links'])) {
            $output['links'] = $this->links;
        }
        if (isset($this->_usedProperties['graphQlOperations'])) {
            $output['graph_ql_operations'] = $this->graphQlOperations;
        }
        if (isset($this->_usedProperties['provider'])) {
            $output['provider'] = $this->provider;
        }
        if (isset($this->_usedProperties['processor'])) {
            $output['processor'] = $this->processor;
        }
        if (isset($this->_usedProperties['stateOptions'])) {
            $output['state_options'] = $this->stateOptions;
        }
        if (isset($this->_usedProperties['rules'])) {
            $output['rules'] = $this->rules;
        }
        if (isset($this->_usedProperties['policy'])) {
            $output['policy'] = $this->policy;
        }
        if (isset($this->_usedProperties['middleware'])) {
            $output['middleware'] = $this->middleware;
        }
        if (isset($this->_usedProperties['parameters'])) {
            $output['parameters'] = $this->parameters;
        }
        if (isset($this->_usedProperties['extraProperties'])) {
            $output['extra_properties'] = $this->extraProperties;
        }
        if (isset($this->_usedProperties['routeName'])) {
            $output['route_name'] = $this->routeName;
        }
        if (isset($this->_usedProperties['errors'])) {
            $output['errors'] = $this->errors;
        }
        if (isset($this->_usedProperties['read'])) {
            $output['read'] = $this->read;
        }
        if (isset($this->_usedProperties['deserialize'])) {
            $output['deserialize'] = $this->deserialize;
        }
        if (isset($this->_usedProperties['validate'])) {
            $output['validate'] = $this->validate;
        }
        if (isset($this->_usedProperties['write'])) {
            $output['write'] = $this->write;
        }
        if (isset($this->_usedProperties['serialize'])) {
            $output['serialize'] = $this->serialize;
        }
        if (isset($this->_usedProperties['priority'])) {
            $output['priority'] = $this->priority;
        }
        if (isset($this->_usedProperties['name'])) {
            $output['name'] = $this->name;
        }
        if (isset($this->_usedProperties['allowCreate'])) {
            $output['allow_create'] = $this->allowCreate;
        }
        if (isset($this->_usedProperties['itemUriTemplate'])) {
            $output['item_uri_template'] = $this->itemUriTemplate;
        }

        return $output + $this->_extraKeys;
    }

    /**
     * @param ParamConfigurator|mixed $value
     *
     * @return $this
     */
    public function set(string $key, mixed $value): static
    {
        $this->_extraKeys[$key] = $value;

        return $this;
    }

}
