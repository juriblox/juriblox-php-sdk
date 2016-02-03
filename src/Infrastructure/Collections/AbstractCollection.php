<?php

namespace JuriBlox\Sdk\Infrastructure\Collections;

use JuriBlox\Sdk\Exceptions\CannotParseResponseException;
use JuriBlox\Sdk\Infrastructure\Drivers\DriverInterface;

abstract class AbstractCollection implements CollectionInterface
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
     * Key used in the result returned by the API
     *
     * @var string
     */
    protected $key;

    /**
     * Current page with records
     *
     * @var array
     */
    protected $records;

    /**
     * URL to retrieve entities from (for example, /templates)
     *
     * @var string
     */
    protected $uri;

    /**
     * AbstractCollection constructor
     */
    private function __construct()
    {
        $this->index = 0;
        $this->records = [];
    }

    /**
     * Initiate a collection
     *
     * @param DriverInterface $driver
     * @param string          $uri
     * @param string          $key
     *
     * @return AbstractCollection
     */
    protected static function fromDriverWithSettings(DriverInterface $driver, $uri, $key)
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
    public function current()
    {
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
}