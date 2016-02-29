<?php

namespace JuriBlox\Sdk\Infrastructure\Collections;

use JuriBlox\Sdk\Domain\Documents\Entities\Template;
use JuriBlox\Sdk\Domain\Documents\Factories\TemplateFactory;
use JuriBlox\Sdk\Infrastructure\Endpoints\EndpointInterface;

class TemplatesCollection extends AbstractPagedCollection
{
    /**
     * @param EndpointInterface $endpoint
     *
     * @return TemplatesCollection
     */
    public static function fromEndpoint($endpoint)
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