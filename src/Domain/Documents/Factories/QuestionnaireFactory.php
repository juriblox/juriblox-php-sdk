<?php

namespace JuriBlox\Sdk\Domain\Documents\Factories;

use JuriBlox\Sdk\Domain\Documents\Values\Questionnaire;

class QuestionnaireFactory
{
    /**
     * Create a Questionnaire from a DTO returned by the JuriBlox API
     *
     * @param $dto
     *
     * @return Questionnaire
     */
    public static function createFromDto($dto)
    {
        $questionnaire = new Questionnaire();

        foreach ($dto->steps as $entry)
        {
            $questionnaire->addStep(QuestionnaireStepFactory::createFromDto($entry));
        }

        return $questionnaire;
    }
}