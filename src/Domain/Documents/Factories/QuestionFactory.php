<?php

namespace JuriBlox\Sdk\Domain\Documents\Factories;

use JuriBlox\Sdk\Domain\Documents\Entities\Question;
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

        // TODO: geen idee wat dit zijn...
        foreach ($dto->parentAnswers as $entry)
        {
            print_r($entry); exit();
        }

        // TODO: geen idee wat dit zijn...
        foreach ($dto->answers as $entry)
        {
            print_r($entry); exit();
        }

        return $question;
    }
}