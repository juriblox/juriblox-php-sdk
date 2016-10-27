<?php

namespace JuriBlox\Sdk\Infrastructure\Collections;

use JuriBlox\Sdk\Infrastructure\Endpoints\CustomTemplatesEndpoint;

class CustomTemplatesCollection extends TemplatesCollection
{
    /**
     * @param CustomTemplatesEndpoint $endpoint
     *
     * @return CustomTemplatesCollection
     */
    public static function fromEndpoint(CustomTemplatesEndpoint $endpoint)
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
