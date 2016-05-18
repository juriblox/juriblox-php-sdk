<?php

namespace JuriBlox\Sdk\Infrastructure\Transformers\Documents;

use JuriBlox\Sdk\Domain\Documents\Values\Questionnaire;
use JuriBlox\Sdk\Infrastructure\Transformers\Documents\QuestionnaireStepTransformer;

class QuestionnaireTransformer
{
    /**
     * Create a Questionnaire from a DTO returned by the JuriBlox API
     *
     * @param $dto
     *
     * @return Questionnaire
     */
    public static function read($dto)
    {
        $questionnaire = new Questionnaire();

        foreach ($dto->steps as $entry)
        {
            $questionnaire->addStep(QuestionnaireStepTransformer::read($entry));
        }

        return $questionnaire;
    }
}