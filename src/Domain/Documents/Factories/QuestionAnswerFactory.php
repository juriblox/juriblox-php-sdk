<?php

namespace JuriBlox\Sdk\Domain\Documents\Factories;

use JuriBlox\Sdk\Domain\Documents\Entities\QuestionAnswer;
use JuriBlox\Sdk\Domain\Documents\Entities\TemplateVariable;

class QuestionAnswerFactory
{
    /**
     * Create a QuestionAnswer from a DTO returned by the JuriBlox API
     *
     * @param $dto
     *
     * @return QuestionAnswer
     */
    public static function createFromDto($dto)
    {
        $answer = QuestionAnswer::fromIdString(/* TODO: $dto->id */0);
        $answer->setQuestion(QuestionFactory::createFromDto($dto->question));
        $answer->setMostRecentQuestion(QuestionFactory::createFromDto($dto->mostRecentQuestion));

        $variable = TemplateVariable::fromIdString($dto->variable->id);
        $variable->setName($dto->variable->name);
        $variable->setTitle($dto->variable->title);
        $variable->setDescription($dto->variable->description);

        $answer->setVariable($variable);
        $answer->setValue($dto->value);

        return $answer;
    }
}