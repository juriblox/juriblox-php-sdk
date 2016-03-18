<?php

namespace JuriBlox\Sdk\Infrastructure\Collections;

use JuriBlox\Sdk\Domain\Documents\Entities\Template;
use JuriBlox\Sdk\Domain\Documents\Factories\TemplateFactory;
use JuriBlox\Sdk\Infrastructure\Endpoints\EndpointInterface;
use JuriBlox\Sdk\Infrastructure\Endpoints\TemplatesEndpoint;

class QuestionsCollection extends AbstractCollection
{
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