<?php

namespace JuriBlox\Sdk\Infrastructure\Collections;

use JuriBlox\Sdk\Domain\Documents\Entities\Template;
use JuriBlox\Sdk\Infrastructure\Transformers\Documents\TemplateTransformer;

class QuestionsCollection extends AbstractCollection
{
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