<?php

namespace JuriBlox\Sdk\Infrastructure\Collections;

use JuriBlox\Sdk\Infrastructure\Drivers\DriverInterface;

class CustomTemplatesCollection extends TemplatesCollection
{
    /**
     * @param DriverInterface $driver
     *
     * @return TemplatesCollection
     */
    public static function fromDriver(DriverInterface $driver)
    {
        return static::fromDriverWithSettings($driver, 'templates/custom', 'templates');
    }
}