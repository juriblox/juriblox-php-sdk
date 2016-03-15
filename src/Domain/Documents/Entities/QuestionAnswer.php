<?php

namespace JuriBlox\Sdk\Domain\Documents\Entities;

use JuriBlox\Sdk\Domain\Documents\Values\AnswerId;
use JuriBlox\Sdk\Domain\Documents\Values\QuestionAnswerId;

class QuestionAnswer
{
    /**
     * ID
     *
     * @var QuestionAnswerId
     */
    private $id;

    /**
     * TODO: ???
     *
     * @var Question
     */
    private $mostRecentQuestion;

    /**
     * Question linked to this answer
     *
     * @var Question
     */
    private $question;

    /**
     * Value
     *
     * @var mixed
     */
    private $value;

    /**
     * The variable this answer belongs to
     *
     * @var TemplateVariable
     */
    private $variable;

    /**
     * Create a QuestionAnswer entity based on an existing identity
     *
     * @param QuestionAnswerId $id
     *
     * @return QuestionAnswer
     */
    public static function fromId(QuestionAnswerId $id)
    {
        $answer = new static();
        $answer->id = $id;

        return $answer;
    }

    /**
     * Create a QuestionAnswer entity based on an identity represented as a string
     *
     * @param string $id
     *
     * @return QuestionAnswer
     */
    public static function fromIdString($id)
    {
        return static::fromId(new QuestionAnswerId($id));
    }

    /**
     * QuestionAnswer constructor
     */
    private function __construct()
    {

    }

    /**
     * @return QuestionAnswerId
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Question
     */
    public function getMostRecentQuestion()
    {
        return $this->mostRecentQuestion;
    }

    /**
     * @return Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return TemplateVariable
     */
    public function getVariable()
    {
        return $this->variable;
    }

    /**
     * @param Question $mostRecentQuestion
     */
    public function setMostRecentQuestion(Question $mostRecentQuestion)
    {
        $this->mostRecentQuestion = $mostRecentQuestion;
    }

    /**
     * @param Question $question
     */
    public function setQuestion(Question $question)
    {
        $this->question = $question;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value ?: null;
    }

    /**
     * @param TemplateVariable $variable
     */
    public function setVariable(TemplateVariable $variable)
    {
        $this->variable = $variable;
    }
}