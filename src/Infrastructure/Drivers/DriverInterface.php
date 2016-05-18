<?php

namespace JuriBlox\Sdk\Infrastructure\Drivers;

use JuriBlox\Sdk\Exceptions\AuthorizationException;
use JuriBlox\Sdk\Exceptions\CannotParseResponseException;
use JuriBlox\Sdk\Exceptions\EngineOperationException;
use JuriBlox\Sdk\Exceptions\RateLimitingException;
use Psr\Log\LoggerInterface;

interface DriverInterface
{
    /**
     * GuzzleDriver constructor
     *
     * @param string        $clientId   JuriBlox API client ID
     * @param string        $clientKey  JuriBlox API client key
     * @param string|null   $baseUri    Custom base URI
     */
    public function __construct($clientId, $clientKey, $baseUri = null);

    /**
     * Send GET request
     *
     * @param      $uri
     * @param null $segments
     *
     * @return object
     *
     * @throws AuthorizationException
     * @throws CannotParseResponseException
     * @throws EngineOperationException
     * @throws RateLimitingException
     */
    public function get($uri, $segments = null);

    /**
     * Send POST request
     *
     * @param      $uri
     * @param null $segments
     * @param      $body
     *
     * @return object
     *
     * @throws AuthorizationException
     * @throws CannotParseResponseException
     * @throws EngineOperationException
     * @throws RateLimitingException
     */
    public function post($uri, $segments = null, $body);

    /**
     * Sets the application's name for easier identification in server logs
     *
     * @param $name
     */
    public function setApplicationName($name);

    /**
     * Override the base URI
     *
     * @param $baseUri
     *
     * @return mixed
     */
    public function setBaseUri($baseUri);

    /**
     * Set PSR-3 logger
     *
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger);
}