<?php

namespace JuriBlox\Sdk\Infrastructure\Drivers;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use JuriBlox\Sdk\Client;
use JuriBlox\Sdk\Exceptions\AuthorizationException;
use JuriBlox\Sdk\Exceptions\CannotParseResponseException;
use JuriBlox\Sdk\Exceptions\EngineOperationException;
use JuriBlox\Sdk\Exceptions\RateLimitingException;
use JuriBlox\Sdk\Validation\Assertion;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class GuzzleDriver implements DriverInterface
{
    /**
     * Authorization error.
     */
    const STATUS_AUTHORIZATION_ERROR = 403;

    /**
     * Resource not found.
     */
    const STATUS_NOT_FOUND = 404;

    /**
     * Unprocessable entity.
     */
    const STATUS_UNPROCESSABLE_ENTITY = 422;

    /**
     * Requests are being throttled due to a requests limit.
     */
    const STATUS_RATE_LIMITING_ERROR = 429;

    /**
     * Request successfully executed.
     */
    const STATUS_SUCCESS = 200;

    /**
     * @var string
     */
    private $applicationName;

    /**
     * @var string
     */
    private $baseUri;

    /**
     * @var GuzzleClient
     */
    private $client;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var HandlerStack
     */
    private $stack;

    /**
     * {@inheritdoc}
     */
    public function __construct($clientId, $clientKey, $baseUri = null)
    {
        $this->stack = HandlerStack::create();

        $this->client = new GuzzleClient([
            'headers'   => [
                'User-Agent'    => $this->buildUserAgent(),

                'X-JuriBlox-Client-Id'  => $clientId,
                'X-JuriBlox-Client-Key' => $clientKey,
            ],
        ]);

        $this->setBaseUri($baseUri ?: 'https://api.juriblox.nl/');
    }

    /**
     * {@inheritdoc}
     */
    public function get($uri, $segments = null)
    {
        return $this->jsonRequest('GET', $uri, $segments);
    }

    /**
     * {@inheritdoc}
     */
    public function getRaw($uri, $segments = null)
    {
        return $this->request('GET', $uri, $segments)->getBody()->getContents();
    }

    /**
     * {@inheritdoc}
     */
    public function patch($uri, $segments, $body)
    {
        return $this->jsonRequest('POST', $uri, $segments, array_merge($body, [
            '_method' => 'PATCH',
        ]));
    }

    /**
     * {@inheritdoc}
     */
    public function post($uri, $segments, $body)
    {
        return $this->jsonRequest('POST', $uri, $segments, $body);
    }

    /**
     * {@inheritdoc}
     */
    public function setApplicationName($applicationName)
    {
        $this->applicationName = $applicationName ?: null;
    }

    /**
     * {@inheritdoc}
     */
    public function setBaseUri($baseUri)
    {
        Assertion::url($baseUri);

        $this->baseUri = trim($baseUri, '/') . '/v1/';
    }

    /**
     * {@inheritdoc}
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;

        $this->stack->remove('logger');
        $this->stack->push(Middleware::log($logger, new MessageFormatter('{method} {target} HTTP/{version} - {code} {res_header_Content-Length}'), LogLevel::INFO), 'logger');
    }

    /**
     * Build a pretty user agent string.
     *
     * @return string
     */
    private function buildUserAgent()
    {
        $userAgent = 'juriblox/php-sdk ' . Client::VERSION;
        if ($this->applicationName !== null) {
            $userAgent .= ' (' . $this->applicationName . ')';
        }

        return $userAgent;
    }

    /**
     * Send a request to the JuriBlox API and parse the resulting JSON.
     *
     * @param            $method
     * @param            $uri
     * @param null       $segments
     * @param array|null $body
     *
     * @return object
     *
     * @throws AuthorizationException
     * @throws CannotParseResponseException
     * @throws EngineOperationException
     * @throws RateLimitingException
     */
    private function jsonRequest($method, $uri, $segments = null, array $body = null)
    {
        $response = $this->request($method, $uri, $segments, $body);

        $result = @json_decode($response->getBody()->getContents());
        if ($result === false) {
            $castedException = new CannotParseResponseException();
            $castedException->setResponseContext($response);

            throw $castedException;
        }

        return $result;
    }

    /**
     * Send a request to the JuriBlox API and return the response.
     *
     * @param       $method
     * @param       $uri
     * @param null  $segments
     * @param array $body
     *
     * @return Response
     *
     * @throws AuthorizationException
     * @throws CannotParseResponseException
     * @throws EngineOperationException
     * @throws RateLimitingException
     */
    private function request($method, $uri, $segments = null, array $body = null)
    {
        $segments = ($segments === null) ? [] : $segments;

        array_walk($segments, function ($value, $name) use (&$uri) {
            $uri = str_replace('{' . $name . '}', $value, $uri);
        }, $uri);

        try {
            /** @var Response $response */
            $response = $this->client->request($method, $uri, [
                'handler'  => $this->stack,
                'base_uri' => $this->baseUri,

                'headers' => [
                    'User-Agent' => $this->buildUserAgent(),
                ],

                'form_params' => $body,
            ]);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();

            $exceptionCode = $exception->getMessage();
            $exceptionMessage = $exception->getCode();

            $result = @json_decode($response->getBody()->getContents());
            if ($result !== false) {
                $exceptionCode = $result->error->code;
                $exceptionMessage = $result->error->message;
            }

            // Throw authorization exception
            if ($response->getStatusCode() == self::STATUS_AUTHORIZATION_ERROR) {
                $castedException = new AuthorizationException($exceptionMessage, $exceptionCode, $exception);
                $castedException->setResponseContext($response);

                throw $castedException;
            }

            // Throw rate limiting exception
            elseif ($response->getStatusCode() == self::STATUS_RATE_LIMITING_ERROR) {
                $castedException = new RateLimitingException($exceptionMessage, $exceptionCode, $exception);
                $castedException->setResponseContext($response);

                throw $castedException;
            }

            // Unprocessable request
            elseif ($response->getStatusCode() == self::STATUS_UNPROCESSABLE_ENTITY) {
                $castedException = new EngineOperationException($exceptionMessage, $exceptionCode, $exception);
                if ($result !== false && isset($result->error->errors)) {
                    if (is_array($result->error->errors)) {
                        $castedException->setErrors($result->error->errors);
                    } elseif (is_object($result->error->errors)) {
                        $castedException->setErrors(get_object_vars($result->error->errors));
                    }
                }

                throw $castedException;
            }

            throw new EngineOperationException($exception->getMessage(), $exception->getCode(), $exception);
        }

        return $response;
    }
}
