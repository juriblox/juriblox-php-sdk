<?php

namespace JuriBlox\Sdk\Infrastructure\Collections;

use JuriBlox\Sdk\Domain\Documents\Entities\Template;
use JuriBlox\Sdk\Infrastructure\Endpoints\TemplatesEndpoint;
use JuriBlox\Sdk\Infrastructure\Transformers\Documents\TemplateTransformer;

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
        return TemplateTransformer::read($dto);
    }
}
