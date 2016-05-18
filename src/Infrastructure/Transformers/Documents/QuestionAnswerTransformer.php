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
        $answer = QuestionAnswer::fromIdString($dto->id);
        $answer->setQuestion(QuestionTransformer::read($dto->question));
        $answer->setValue($dto->value);

        $answer->setMostRecentQuestion(QuestionTransformer::read($dto->mostRecentQuestion));

        if (isset($dto->variable))
        {
            $variable = TemplateVariable::fromIdString($dto->variable->id);
            $variable->setName($dto->variable->name);
            $variable->setTitle($dto->variable->title);
            $variable->setDescription($dto->variable->description);

            $answer->setVariable($variable);
        }

        return $answer;
    }
}