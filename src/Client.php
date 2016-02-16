<?php

namespace JuriBlox\Sdk;

use JuriBlox\Sdk\Infrastructure\Collections\CustomTemplatesCollection;
use JuriBlox\Sdk\Infrastructure\Drivers\Driver;
use JuriBlox\Sdk\Infrastructure\Drivers\DriverInterface;
use JuriBlox\Sdk\Infrastructure\Endpoints\CustomersEndpoint;
use JuriBlox\Sdk\Infrastructure\Endpoints\CustomTemplatesEndpoint;
use JuriBlox\Sdk\Infrastructure\Endpoints\DocumentsEndpoint;
use JuriBlox\Sdk\Infrastructure\Endpoints\TemplatesEndpoint;

class Client
{
    /**
     * Client version
     */
    const VERSION = '0.0.1';

    /**
     * @var null|string
     */
    private $applicationName;

    /**
     * @var Driver
     */
    private $driver;

    /**
     * @param DriverInterface   $driver
     * @param string            $applicationName       Web application's name for easier identification in logs
     */
    public function __construct(DriverInterface $driver, $applicationName = null)
    {
        $this->applicationName = $applicationName;

        $this->driver = $driver;
        $this->driver->setApplicationName($applicationName);
    }

    /**
     * Get an endpoint for working with the custom templates
     *
     * @return CustomTemplatesCollection
     */
    public function customTemplates()
    {
        return CustomTemplatesEndpoint::fromDriver($this->driver);
    }

    /**
     * Get an endpoint for working with customers
     *
     * @return CustomersEndpoint
     */
    public function customers()
    {
        return CustomersEndpoint::fromDriver($this->driver);
    }

    /**
     * Get an endpoint for working with documents
     *
     * @return DocumentsEndpoint
     */
    public function documents()
    {
        return DocumentsEndpoint::fromDriver($this->driver);
    }

    /**
     * Get an endpoint for working with templates
     *
     * @return TemplatesEndpoint
     */
    public function templates()
    {
        return TemplatesEndpoint::fromDriver($this->driver);
    }
}