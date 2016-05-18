<?php

namespace JuriBlox\Sdk\Infrastructure\Transformers\Documents;

use JuriBlox\Sdk\Domain\Documents\Entities\QuestionAnswer;
use JuriBlox\Sdk\Domain\Documents\Entities\TemplateVariable;
use JuriBlox\Sdk\Infrastructure\Transformers\Documents\QuestionTransformer;

class QuestionAnswerTransformer
{
    /**
     * Create a QuestionAnswer from a DTO returned by the JuriBlox API
     *
     * @param $dto
     *
     * @return QuestionAnswer
     */
    public static function read($dto)
    {
        $answer = QuestionAnswer::fromIdString(/* TODO: $dto->id */0);
        $answer->setQuestion(QuestionTransformer::read($dto->question));
        $answer->setMostRecentQuestion(QuestionTransformer::read($dto->mostRecentQuestion));

        $variable = TemplateVariable::fromIdString($dto->variable->id);
        $variable->setName($dto->variable->name);
        $variable->setTitle($dto->variable->title);
        $variable->setDescription($dto->variable->description);

        $answer->setVariable($variable);
        $answer->setValue($dto->value);

        return $answer;
    }
}