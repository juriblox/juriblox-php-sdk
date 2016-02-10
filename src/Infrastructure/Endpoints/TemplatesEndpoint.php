<?php

namespace JuriBlox\Sdk\Infrastructure\Endpoints;

use JuriBlox\Sdk\Infrastructure\Collections\TemplatesCollection;

class TemplatesEndpoint extends AbstractEndpoint
{
    /**
     * Get all templates
     *
     * @return TemplatesCollection
     */
    public function getAll()
    {
        return TemplatesCollection::fromDriver($this->driver);
    }
}