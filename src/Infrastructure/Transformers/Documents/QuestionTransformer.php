<?php

namespace JuriBlox\Sdk\Infrastructure\Transformers\Documents;

use JuriBlox\Sdk\Domain\Documents\Entities\Question;
use JuriBlox\Sdk\Domain\Documents\Entities\QuestionOption;
use JuriBlox\Sdk\Domain\Documents\Values\QuestionCondition;
use JuriBlox\Sdk\Domain\Documents\Values\QuestionId;
use JuriBlox\Sdk\Domain\Documents\Values\QuestionOptionCondition;
use JuriBlox\Sdk\Domain\Documents\Values\QuestionOptionId;
use JuriBlox\Sdk\Domain\Documents\Values\QuestionType;

class QuestionTransformer
{
    /**
     * Create a Question from a DTO returned by the JuriBlox API.
     *
     * @param $dto
     *
     * @return Question
     */
    public static function read($dto)
    {
        $question = Question::fromIdString($dto->id);
        $question->setFirstId(new QuestionId($dto->revision->derivedOf));

        $question->setName($dto->name);
        $question->setInfo($dto->info);
        $question->setType(new QuestionType($dto->type));
        $question->setRequired($dto->required);

        $question->setDefault($dto->default);
        $question->setConditionOperator($dto->conditionOperator ?? 'or');

        // Required parent question
        if (isset($dto->parent)) {
            $question->addQuestionCondition(new QuestionCondition(new QuestionId($dto->parent->id)));
        }

        // Conditional logic for questions
        foreach ($dto->parentAnswers as $entry) {
            $question->addOptionCondition(new QuestionOptionCondition(new QuestionOptionId($entry->id)));
        }

        // Allowed options for this questions (they're called answers in the v1 API)
        foreach ($dto->answers as $entry) {
            $option = QuestionOption::fromIdString($entry->id);
            $option->setFirstId(new QuestionOptionId($entry->revision->derivedOf));

            $option->setTitle($entry->name);
            $option->setValue($entry->value);
            $option->setDefault($entry->default);
            $option->setPosition($entry->position);

            $question->addOption($option);
        }

        return $question;
    }
}
