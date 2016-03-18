<?php

namespace JuriBlox\Sdk\Domain\Documents\Factories;

use JuriBlox\Sdk\Domain\Documents\Entities\Question;
use JuriBlox\Sdk\Domain\Documents\Entities\QuestionOption;
use JuriBlox\Sdk\Domain\Documents\Values\QuestionCondition;
use JuriBlox\Sdk\Domain\Documents\Values\QuestionOptionId;
use JuriBlox\Sdk\Domain\Documents\Values\QuestionType;

class QuestionFactory
{
    /**
     * Create a Question from a DTO returned by the JuriBlox API
     *
     * @param $dto
     *
     * @return Question
     */
    public static function createFromDto($dto)
    {
        $question = Question::fromIdString($dto->id);
        $question->setName($dto->name);
        $question->setInfo($dto->info);
        $question->setType(new QuestionType($dto->type));
        $question->setRequired($dto->required);

        // Conditional logic for questions
        foreach ($dto->parentAnswers as $entry)
        {
            $question->addCondition(new QuestionCondition(new QuestionOptionId($entry->id), $entry->value));
        }

        // Allowed options for this questions (they're called answers in the v1 API)
        foreach ($dto->answers as $entry)
        {
            $option = QuestionOption::fromIdString($entry->id);
            $option->setValue($entry->value);

            $question->addOption($option);
        }

        return $question;
    }
}