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
     * GuzzleDriver constructor.
     *
     * @param string      $clientId   JuriBlox API client ID
     * @param string      $clientKey  JuriBlox API client key
     * @param string|null $baseUri    Custom base URI
     * @param string      $apiVersion The version of the API to use, either v1 or v2.
     */
    public function __construct($clientId, $clientKey, $baseUri = null, $apiVersion = 'v1');

    /**
     * Send GET request and parse the returned JSON.
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
     * Send GET request and return the raw contents.
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
    public function getRaw($uri, $segments = null);

    /**
     * Send PATCH request and parse the returned JSON.
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
    public function patch($uri, $segments, $body);

    /**
     * Send POST request and parse the returned JSON.
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
    public function post($uri, $segments, $body);
    
    /**
     * Send DELETE request and parse the returned JSON.
     *
     * @param string $uri
     * @param array  $segments
     * @param array  $body
     *
     * @return object
     *
     * @throws AuthorizationException
     * @throws CannotParseResponseException
     * @throws EngineOperationException
     * @throws RateLimitingException
     */
    public function delete($uri, $segments, $body);

    /**
     * Sets the application's name for easier identification in server logs.
     *
     * @param $name
     */
    public function setApplicationName($name);

    /**
     * Override the base URI.
     *
     * @param string $baseUri
     * @param string $apiVersion
     *
     * @return mixed
     */
    public function setBaseUri($baseUri, $apiVersion = 'v1');

    /**
     * Set PSR-3 logger.
     *
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger);
}
