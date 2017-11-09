<?php

namespace JuriBlox\Sdk\Infrastructure\Transformers\Documents;

use JuriBlox\Sdk\Domain\Documents\Values\DocumentVariable;
use JuriBlox\Sdk\Domain\Documents\Values\TemplateVariableId;

class DocumentVariableTransformer
{
    /**
     * Create a DocumentVariable from a DTO returned by the JuriBlox API.
     *
     * @param $dto
     *
     * @return DocumentVariable
     */
    public static function read($dto)
    {
        if (isset($dto->id)) {
            return DocumentVariable::fromId(new TemplateVariableId($dto->id), $dto->variable, $dto->value);
        }

        return DocumentVariable::fromName($dto->variable, $dto->value);
    }
}
