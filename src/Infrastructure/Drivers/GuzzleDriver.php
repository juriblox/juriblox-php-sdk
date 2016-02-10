<?php

namespace JuriBlox\Sdk\Infrastructure\Drivers;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;

use JuriBlox\Sdk\Client;
use JuriBlox\Sdk\Exceptions\AuthorizationException;
use JuriBlox\Sdk\Exceptions\RateLimitingException;
use JuriBlox\Sdk\Exceptions\CannotParseResponseException;

class GuzzleDriver implements DriverInterface
{
    /**
     * Authorization error
     */
    const STATUS_AUTHORIZATION_ERROR = 403;

    /**
     * Requests are being throttled due to a requests limit
     */
    const STATUS_RATE_LIMITING_ERROR = 429;

    /**
     * Request successfully executed
     */
    const STATUS_SUCCESS = 200;

    /**
     * @var GuzzleClient
     */
    private $client;

    /**
     * @var string
     */
    private $applicationName;

    /**
     * {@inheritdoc}
     */
    public function __construct($clientId, $clientKey)
    {
        $this->client = new GuzzleClient([
            'base_uri'  => 'https://api.juriblox.nl/v1/',

            'headers'   => [
                'User-Agent'    => $this->buildUserAgent(),

                'X-JuriBlox-Client-Id'  => $clientId,
                'X-JuriBlox-Client-Key' => $clientKey
            ]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function get($uri, $parameters = null)
    {
        return $this->request('GET', $uri, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function post($uri, $parameters = null, $body)
    {
        return $this->request('POST', $uri, $parameters, $body);
    }

    /**
     * {@inheritdoc}
     */
    public function setApplicationName($applicationName)
    {
        $this->applicationName = $applicationName ?: null;
    }

    /**
     * Build a pretty user agent string
     *
     * @return string
     */
    private function buildUserAgent()
    {
        $userAgent = 'juriblox/php-sdk ' . Client::VERSION;
        if ($this->applicationName !== null)
        {
            $userAgent .= ' (' . $this->applicationName . ')';
        }

        return $userAgent;
    }

    /**
     * Send a request to the JuriBlox API and return the response as an object
     *
     * @param       $method
     * @param       $uri
     * @param null  $parameters
     * @param array $body
     *
     * @return object
     *
     * @throws AuthorizationException
     * @throws CannotParseResponseException
     * @throws RateLimitingException
     */
    private function request($method, $uri, $parameters = null, array $body = null)
    {
        $parameters = ($parameters === null) ? [] : $parameters;

        array_walk($parameters, function($value, $name) use (&$uri) {
            $uri = str_replace('{' . $name . '}', $value, $uri);
        }, $uri);

        try
        {
            /** @var Response $response */
            $response = $this->client->request($method, $uri, [
                'headers' => [
                    'User-Agent' => $this->buildUserAgent(),
                ],

                'form_params' => $body
            ]);
        }
        catch (ClientException $exception)
        {
            $response = $exception->getResponse();

            $exceptionCode = null;
            $exceptionMessage = null;

            $result = @json_decode($response->getBody()->getContents());
            if ($result !== false)
            {
                $exceptionCode = $result->error->code;
                $exceptionMessage = $result->error->message;
            }

            // Throw authorization exception
            if ($response->getStatusCode() == self::STATUS_AUTHORIZATION_ERROR)
            {
                throw (new AuthorizationException($exceptionMessage, $exceptionCode))->setResponseContext($response);
            }

            // Throw rate limiting exception
            elseif ($response->getStatusCode() == self::STATUS_RATE_LIMITING_ERROR)
            {
                throw (new RateLimitingException($exceptionMessage, $exceptionCode))->setResponseContext($response);
            }

            throw $exception;
        }

        $result = @json_decode($response->getBody()->getContents());
        if ($result === false)
        {
            throw (new CannotParseResponseException())->setResponseContext($response);
        }

        return $result;
    }
}