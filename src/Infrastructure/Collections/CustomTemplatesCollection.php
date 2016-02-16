<?php

namespace JuriBlox\Sdk\Infrastructure\Collections;

use JuriBlox\Sdk\Infrastructure\Drivers\DriverInterface;

class CustomTemplatesCollection extends TemplatesCollection
{
    /**
     * {@inheritdoc}
     */
    public static function fromDriver(DriverInterface $driver)
    {
        return static::fromDriverWithSettings($driver, 'templates/custom', 'templates');
    }

    /**
     * {@inheritdoc}
     */
    public function createEntityFromData($dto)
    {
        $template = parent::createEntityFromData($dto);
        $template->setCustom(true);

        return $template;
    }
}