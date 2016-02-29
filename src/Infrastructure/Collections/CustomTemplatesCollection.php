<?php

namespace JuriBlox\Sdk\Infrastructure\Collections;

use JuriBlox\Sdk\Infrastructure\Endpoints\EndpointInterface;

class CustomTemplatesCollection extends TemplatesCollection
{
    /**
     * @param EndpointInterface $endpoint
     *
     * @return CustomTemplatesCollection
     */
    public static function fromEndpoint($endpoint)
    {
        return static::fromEndpointWithSettings($endpoint, 'templates/custom', 'templates');
    }

    /**
     * {@inheritdoc}
     */
    protected function createEntityFromData($dto)
    {
        $template = parent::createEntityFromData($dto);
        $template->setCustom(true);

        return $template;
    }
}