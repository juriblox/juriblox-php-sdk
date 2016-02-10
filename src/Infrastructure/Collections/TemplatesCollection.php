<?php

namespace JuriBlox\Sdk\Infrastructure\Collections;

use JuriBlox\Sdk\Entities\Template;
use JuriBlox\Sdk\Infrastructure\Drivers\DriverInterface;

class TemplatesCollection extends AbstractPagedCollection
{
    /**
     * @param DriverInterface $driver
     *
     * @return TemplatesCollection
     */
    public static function fromDriver(DriverInterface $driver)
    {
        return static::fromDriverWithSettings($driver, 'templates', 'templates');
    }

    /**
     * @param $dto
     *
     * @return Template
     */
    public function createEntityFromData($dto)
    {
        $template = Template::fromIdString($dto->id);

        return $template;
    }
}