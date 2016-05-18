<?php

namespace JuriBlox\Sdk\Infrastructure\Collections;

use JuriBlox\Sdk\Domain\Documents\Entities\Template;
use JuriBlox\Sdk\Infrastructure\Factories\Documents\TemplateFactory;

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