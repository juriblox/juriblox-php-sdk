<?php

namespace JuriBlox\Sdk\Domain\Documents\Entities;

use JuriBlox\Sdk\Domain\Documents\Values\QuestionnaireStepId;

class QuestionnaireStep implements \Iterator, \Countable
{
    /**
     * Description
     *
     * @var string
     */
    private $description;

    /**
     * ID
     *
     * @var QuestionnaireStepId
     */
    private $id;

    /**
     * Name
     *
     * @var string
     */
    private $name;

    /**
     * Questions in this step
     *
     * @var array|Question[]
     */
    private $questions;

    /**
     * @var int
     */
    private $questionsIndex;

    /**
     * Create a QuestionnaireStep entity based on an existing identity
     *
     * @param QuestionnaireStepId $id
     *
     * @return QuestionnaireStep
     */
    public static function fromId(QuestionnaireStepId $id)
    {
        $question = new static();
        $question->id = $id;

        return $question;
    }

    /**
     * Create a QuestionnaireStep entity based on an identity represented as a string
     *
     * @param string $id
     *
     * @return QuestionnaireStep
     */
    public static function fromIdString($id)
    {
        return static::fromId(new QuestionnaireStepId($id));
    }

    /**
     * Question constructor
     */
    private function __construct()
    {
        $this->clearQuestions();
    }

    /**
     * Link a question to this step
     *
     * @param Question $question
     */
    public function addQuestion(Question $question)
    {
        $this->questions[] = $question;
    }

    /**
     * Clear the questions linked to this step
     */
    public function clearQuestions()
    {
        $this->questions = [];
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return sizeof($this->questions);
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        if (!$this->valid())
        {
            return null;
        }

        return $this->questions[$this->questionsIndex];
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return QuestionnaireStepId
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array|Question[]
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return $this->questionsIndex;
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        $this->questionsIndex++;
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        $this->questionsIndex = 0;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description ?: null;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name ?: null;
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        return isset($this->steps[$this->questionsIndex]);
    }
}