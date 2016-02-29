<?php

namespace JuriBlox\Sdk\Infrastructure\Collections;

use JuriBlox\Sdk\Exceptions\CannotParseResponseException;
use JuriBlox\Sdk\Infrastructure\Endpoints\EndpointInterface;
use JuriBlox\Sdk\Validation\Assertion;

abstract class AbstractCollection implements \Iterator, \Countable
{
    /**
     * @var EndpointInterface
     */
    protected $endpoint;

    /**
     * Index within the current page
     *
     * @var int
     */
    protected $index;

    /**
     * Current page with records
     *
     * @var array
     */
    protected $records;

    /**
     * Key used in the result returned by the API
     *
     * @var string
     */
    private $key;

    /**
     * GET parameters in the URL
     *
     * @var array
     */
    private $parameters;

    /**
     * URL to retrieve entities from (for example, /templates)
     *
     * @var string
     */
    private $uri;

    /**
     * Initiate a collection along with the URI and key
     *
     * @param EndpointInterface $endpoint
     *
     * @param string $uri
     * @param string $key
     *
     * @return AbstractCollection
     */
    public static function fromEndpointWithSettings($endpoint, $uri, $key)
    {
        // TODO: Totdat de interfaces van PHP eindelijk volwassen worden
        Assertion::isInstanceOf($endpoint, EndpointInterface::class);

        $collection = new static();
        $collection->endpoint = $endpoint;
        $collection->uri = $uri;
        $collection->key = $key;

        return $collection;
    }

    /**
     * AbstractCollection constructor
     */
    protected function __construct()
    {
        $this->index = 0;
        $this->records = [];

        $this->clearUriQueryParameters();
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return sizeof($this->records);
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        if (!$this->valid())
        {
            return null;
        }

        return $this->createEntityFromData($this->records[$this->index]);
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return $this->index;
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        $this->index++;
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        $this->fetch();
        $this->index = 0;
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        return isset($this->records[$this->index]);
    }

    /**
     * Clear the URI parameters we have defined
     */
    protected function clearUriQueryParameters()
    {
        $this->parameters = [];
    }

    /**
     * Create an entity based on a DTO object
     *
     * @param $dto
     */
    protected function createEntityFromData($dto)
    {
        throw new \BadMethodCallException();
    }

    /**
     * Fetch resultset
     */
    protected function fetch()
    {
        $result = $this->driver->get($this->uri);

        if (!isset($result->{$this->key}))
        {
            throw new CannotParseResponseException(sprintf('The "%s" key does not exist in the result returned by the API'));
        }

        $this->records = $result->{$this->key};
    }

    /**
     * @return string
     */
    protected function getCombinedUri()
    {
        if (sizeof($this->parameters) == 0)
        {
            return $this->getUri();
        }

        return $this->getUri() . '?' . http_build_query($this->parameters);
    }

    /**
     * @return string
     */
    protected function getKey()
    {
        return $this->key;
    }

    /**
     * @return string
     */
    protected function getUri()
    {
        return $this->uri;
    }

    /**
     * Merge the URI parameters
     *
     * @param $parameters
     */
    protected function mergeUriQueryParameters($parameters)
    {
        foreach ($parameters as $name => $value)
        {
            $this->setUriQueryParameter($name, $value);
        }
    }

    /**
     * Replace the value of an existing URI parameter
     *
     * @param $name
     * @param $value
     */
    protected function replaceUriQueryParameter($name, $value)
    {
        if (!array_key_exists($name, $this->parameters))
        {
            throw new \InvalidArgumentException(sprintf('The URI parameter "%s" is unknown. Use setUriParameter() if this is by design', $name));
        }

        $this->setUriQueryParameter($name, $value);
    }

    /**
     * @param string $key
     */
    protected function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @param string $uri
     * @param array  $inlineParameters
     */
    protected function setUri($uri, array $inlineParameters = [])
    {
        $this->uri = $uri;

        array_walk($inlineParameters, function($value, $name) use (&$uri) {
            $uri = str_replace('{' . $name . '}', $value, $uri);
        }, $uri);
    }

    /**
     * Add or replace the value of a URI parameter
     *
     * @param $name
     * @param $value
     */
    protected function setUriQueryParameter($name, $value)
    {
        $this->parameters[$name] = $value;
    }

    /**
     * Set the URI parameters
     *
     * @param array $parameters
     */
    protected function setUriQueryParameters(array $parameters)
    {
        $this->parameters = $parameters;
    }
}