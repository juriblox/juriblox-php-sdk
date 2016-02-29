<?php

namespace JuriBlox\Sdk\Infrastructure\Endpoints;

use JuriBlox\Sdk\Infrastructure\Collections\TemplatesCollection;

class TemplatesEndpoint extends AbstractEndpoint implements EndpointInterface
{
    /**
     * Get all templates
     *
     * @return TemplatesCollection
     */
    public function findAll()
    {
        return TemplatesCollection::fromEndpoint($this);
    }
}