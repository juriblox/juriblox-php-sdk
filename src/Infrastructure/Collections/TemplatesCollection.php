<?php

namespace JuriBlox\Sdk\Infrastructure\Collections;

use JuriBlox\Sdk\Domain\Documents\Entities\Template;
use JuriBlox\Sdk\Infrastructure\Factories\Documents\TemplateFactory;
use JuriBlox\Sdk\Infrastructure\Endpoints\TemplatesEndpoint;

class TemplatesCollection extends AbstractPagedCollection
{
    /**
     * @param TemplatesEndpoint $endpoint
     *
     * @return TemplatesCollection
     */
    public static function fromEndpoint(TemplatesEndpoint $endpoint)
    {
        return static::fromEndpointWithSettings($endpoint, 'templates', 'templates');
    }

    /**
     * @param $dto
     *
     * @return Template
     */
    protected function createEntityFromData($dto)
    {
        return TemplateFactory::createFromDto($dto);
    }
}