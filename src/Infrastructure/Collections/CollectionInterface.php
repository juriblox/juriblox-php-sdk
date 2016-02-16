<?php

namespace JuriBlox\Sdk\Infrastructure\Collections;

use JuriBlox\Sdk\Domain\EntityInterface;
use JuriBlox\Sdk\Infrastructure\Drivers\DriverInterface;

interface CollectionInterface
{
    /**
     * Create a collection instance based on an existing driver
     *
     * @param DriverInterface $driver
     *
     * @return mixed
     */
    static function fromDriver(DriverInterface $driver);

    /**
     * Generate an entity object based on data return from the API
     *
     * @param $dto
     *
     * @return EntityInterface
     */
    function createEntityFromData($dto);
}