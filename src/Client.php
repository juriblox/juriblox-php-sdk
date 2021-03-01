<?php

namespace JuriBlox\Sdk;

use JuriBlox\Sdk\Infrastructure\Collections\CustomTemplatesCollection;
use JuriBlox\Sdk\Infrastructure\Drivers\DriverInterface;
use JuriBlox\Sdk\Infrastructure\Endpoints\CustomersEndpoint;
use JuriBlox\Sdk\Infrastructure\Endpoints\CustomTemplatesEndpoint;
use JuriBlox\Sdk\Infrastructure\Endpoints\DocumentCollaborationsEndpoint;
use JuriBlox\Sdk\Infrastructure\Endpoints\DocumentsEndpoint;
use JuriBlox\Sdk\Infrastructure\Endpoints\TemplatesEndpoint;
use Psr\Log\LoggerInterface;

class Client
{
    /**
     * Client version.
     */
    const VERSION = '1.1.0';

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var null|string
     */
    private $name;

    /**
     * @var DriverInterface
     */
    private $driver;

    /**
     * @param DriverInterface $driver
     */
    private function __construct(DriverInterface $driver)
    {
        $this->driver = $driver;
    }

    /**
     * Get an endpoint for working with the custom templates.
     *
     * @return CustomTemplatesCollection
     */
    public function customTemplates()
    {
        return CustomTemplatesEndpoint::fromDriver($this->driver);
    }

    /**
     * Get an endpoint for working with customers.
     *
     * @return CustomersEndpoint
     */
    public function customers()
    {
        return CustomersEndpoint::fromDriver($this->driver);
    }

    /**
     * Get an endpoint for working with documents.
     *
     * @return DocumentsEndpoint
     */
    public function documents()
    {
        return DocumentsEndpoint::fromDriver($this->driver);
    }
    
    /**
     * @return Infrastructure\Endpoints\AbstractEndpoint|DocumentCollaborationsEndpoint
     */
    public function collaborations()
    {
        return DocumentCollaborationsEndpoint::fromDriver($this->driver);
    }

    /**
     * @param DriverInterface $driver
     *
     * @return Client
     */
    public static function fromDriver(DriverInterface $driver)
    {
        return new static($driver);
    }

    /**
     * @param DriverInterface $driver
     * @param                 $name
     *
     * @return Client
     */
    public static function fromDriverWithName(DriverInterface $driver, $name)
    {
        $client = static::fromDriver($driver);
        $client->setName($name);

        return $client;
    }

    /**
     * Get an endpoint for working with templates.
     *
     * @return TemplatesEndpoint
     */
    public function templates()
    {
        return TemplatesEndpoint::fromDriver($this->driver);
    }

    /**
     * Set a PSR-3 logger.
     *
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;

        $this->driver->setLogger($logger);
    }

    /**
     * Set the application's name.
     *
     * @param $name
     */
    private function setName($name)
    {
        $this->name = $name;
        $this->driver->setApplicationName($name);
    }
}
