<?php

namespace JuriBlox\Sdk\Infrastructure\Endpoints;

use JuriBlox\Sdk\Infrastructure\Drivers\DriverInterface;

abstract class AbstractEndpoint
{
    /**
     * @var DriverInterface
     */
    protected $driver;

    /**
     * Create an endpoint using an existing Driver object
     *
     * @param DriverInterface $driver
     *
     * @return AbstractEndpoint
     */
    public static function fromDriver(DriverInterface $driver)
    {
        return new static($driver);
    }

    /**
     * AbstractEndpoint constructor
     *
     * @param DriverInterface $driver
     */
    protected function __construct(DriverInterface $driver)
    {
        $this->driver = $driver;
    }
}