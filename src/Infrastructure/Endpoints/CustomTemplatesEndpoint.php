<?php

namespace JuriBlox\Sdk\Infrastructure\Endpoints;

use JuriBlox\Sdk\Infrastructure\Collections\CustomTemplatesCollection;
use JuriBlox\Sdk\Infrastructure\Collections\TemplatesCollection;

class CustomTemplatesEndpoint extends AbstractEndpoint
{
    /**
     * Get all templates
     *
     * @return TemplatesCollection
     */
    public function findAll()
    {
        return CustomTemplatesCollection::fromDriver($this->driver);
    }
}