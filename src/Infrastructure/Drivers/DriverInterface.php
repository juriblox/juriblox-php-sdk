<?php

namespace JuriBlox\Sdk\Infrastructure\Drivers;

use JuriBlox\Sdk\Exceptions\AuthorizationException;
use JuriBlox\Sdk\Exceptions\RateLimitingException;

interface DriverInterface
{
    /**
     * GuzzleDriver constructor
     *
     * @param   string  $clientId      JuriBlox API client ID
     * @param   string  $clientKey     JuriBlox API client key
     */
    function __construct($clientId, $clientKey);

    /**
     * Send GET request
     *
     * @param      $uri
     * @param null $parameters
     *
     * @return object
     *
     * @throws AuthorizationException
     * @throws CannotParseResponseException
     * @throws RateLimitingException
     */
    function get($uri, $parameters = null);

    /**
     * Send POST request
     *
     * @param      $uri
     * @param null $parameters
     * @param      $body
     *
     * @return object
     *
     * @throws AuthorizationException
     * @throws CannotParseResponseException
     * @throws RateLimitingException
     */
    function post($uri, $parameters = null, $body);

    /**
     * Sets the application's name for easier identification in server logs
     *
     * @param $name
     */
    function setApplicationName($name);
}