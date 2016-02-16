<?php

namespace JuriBlox\Sdk\Infrastructure\Collections;

use JuriBlox\Sdk\Assertion;
use JuriBlox\Sdk\Exceptions\CannotParseResponseException;
use JuriBlox\Sdk\Infrastructure\Drivers\DriverInterface;

abstract class AbstractCollection implements CollectionInterface, \Iterator, \Countable
{
    /**
     * Driver to use to perform requests
     *
     * @var DriverInterface
     */
    protected $driver;

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
     * URL to retrieve entities from (for example, /templates)
     *
     * @var string
     */
    private $uri;

    /**
     * AbstractCollection constructor
     */
    protected function __construct()
    {
        $this->index = 0;
        $this->records = [];
    }

    /**
     * Initiate a collection along with the URI and key
     *
     * @param DriverInterface $driver
     * @param string          $uri
     * @param string          $key
     *
     * @return AbstractCollection
     */
    public static function fromDriverWithSettings(DriverInterface $driver, $uri, $key)
    {
        $collection = new static();
        $collection->driver = $driver;
        $collection->uri = $uri;
        $collection->key = $key;

        return $collection;
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

        return static::createEntityFromData($this->records[$this->index]);
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
     * @param string $key
     */
    protected function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @param string $uri
     * @param array $parameters
     */
    protected function setUri($uri, $parameters = [])
    {
        Assertion::isArray($parameters);

        array_walk($parameters, function($value, $name) use (&$uri) {
            $uri = str_replace('{' . $name . '}', $value, $uri);
        }, $uri);

        $this->uri = $uri;
    }
}