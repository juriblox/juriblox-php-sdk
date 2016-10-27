<?php

namespace JuriBlox\Sdk\Infrastructure\Transformers\Documents;

use JuriBlox\Sdk\Domain\Documents\Entities\QuestionnaireStep;

class QuestionnaireStepTransformer
{
    /**
     * Create a QuestionnaireStep from a DTO returned by the JuriBlox API.
     *
     * @param $dto
     *
     * @return QuestionnaireStep
     */
    public static function read($dto)
    {
        $step = QuestionnaireStep::fromIdString($dto->id);
        $step->setName($dto->name);
        $step->setDescription($dto->description);

        foreach ($dto->questions->questions as $entry) {
            $step->addQuestion(QuestionTransformer::read($entry));
        }

        return $step;
    }
}
