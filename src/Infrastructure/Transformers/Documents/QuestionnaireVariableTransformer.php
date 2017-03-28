<?php

namespace JuriBlox\Sdk\Infrastructure\Transformers\Documents;

use JuriBlox\Sdk\Domain\Documents\Entities\QuestionnaireVariable;

class QuestionnaireVariableTransformer
{
    /**
     * Create a QuestionnaireVariable from a DTO returned by the JuriBlox API.
     *
     * @param $dto
     *
     * @return QuestionnaireVariable
     */
    public static function read($dto)
    {
        return QuestionnaireVariable::create($dto->name, $dto->type, $dto->required);
    }
}
