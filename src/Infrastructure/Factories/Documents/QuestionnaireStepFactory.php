<?php

namespace JuriBlox\Sdk\Infrastructure\Factories\Documents;

use JuriBlox\Sdk\Domain\Documents\Entities\QuestionnaireStep;
use JuriBlox\Sdk\Domain\Documents\Values\Questionnaire;

class QuestionnaireStepFactory
{
    /**
     * Create a QuestionnaireStep from a DTO returned by the JuriBlox API
     *
     * @param $dto
     *
     * @return QuestionnaireStep
     */
    public static function createFromDto($dto)
    {
        $step = QuestionnaireStep::fromIdString($dto->id);
        $step->setName($dto->name);
        $step->setDescription($dto->description);

        foreach ($dto->questions->questions as $entry)
        {
            $step->addQuestion(QuestionFactory::createFromDto($entry));
        }

        return $step;
    }
}