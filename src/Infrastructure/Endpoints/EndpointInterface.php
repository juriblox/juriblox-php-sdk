<?php
namespace JuriBlox\Sdk\Infrastructure\Endpoints;

use JuriBlox\Sdk\Infrastructure\Drivers\DriverInterface;

interface EndpointInterface
{
    /**
     * Initiate an endpoint based on a Driver
     *
     * @param DriverInterface $driver
     *
     * @return AbstractEndpoint
     */
    static function fromDriver(DriverInterface $driver);

    /**
     * Get current Driver object
     *
     * @return DriverInterface
     */
    function getDriver();
}