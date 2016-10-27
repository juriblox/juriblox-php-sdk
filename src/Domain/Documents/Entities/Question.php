<?php

namespace JuriBlox\Sdk\Domain\Documents\Entities;

use JuriBlox\Sdk\Domain\Documents\Values\QuestionCondition;
use JuriBlox\Sdk\Domain\Documents\Values\QuestionId;
use JuriBlox\Sdk\Domain\Documents\Values\QuestionType;

class Question
{
    /**
     * Conditions for this question to appear.
     *
     * @var array|QuestionCondition[]
     */
    private $conditions;

    /**
     * ID.
     *
     * @var QuestionId
     */
    private $id;

    /**
     * Information.
     *
     * @var string
     */
    private $info;

    /**
     * Question name.
     *
     * @var string
     */
    private $name;

    /**
     * List of options.
     *
     * @var array|QuestionOption[]
     */
    private $options;

    /**
     * Required field.
     *
     * @var bool
     */
    private $required;

    /**
     * Question type.
     *
     * @var QuestionType
     */
    private $type;

    /**
     * Question constructor.
     */
    private function __construct()
    {
        $this->clearConditions();
        $this->clearOptions();
    }

    /**
     * Create a Question entity based on an existing identity.
     *
     * @param QuestionId $id
     *
     * @return Question
     */
    public static function fromId(QuestionId $id)
    {
        $question = new static();
        $question->id = $id;

        return $question;
    }

    /**
     * Create a Question entity based on an identity represented as a string.
     *
     * @param string $id
     *
     * @return Question
     */
    public static function fromIdString($id)
    {
        return static::fromId(new QuestionId($id));
    }

    /**
     * Add a condition.
     *
     * @param QuestionCondition $condition
     */
    public function addCondition(QuestionCondition $condition)
    {
        $this->conditions[] = $condition;
    }

    /**
     * Add an option.
     *
     * @param QuestionOption $option
     */
    public function addOption(QuestionOption $option)
    {
        $this->options[] = $option;
    }

    /**
     * Clear the linked conditions.
     */
    public function clearConditions()
    {
        $this->conditions = [];
    }

    /**
     * Clear the question's options.
     */
    public function clearOptions()
    {
        $this->options = [];
    }

    /**
     * @return array|QuestionCondition[]
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * @return QuestionId
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array|QuestionOption[]
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @return QuestionType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return bool
     */
    public function isRequired()
    {
        return $this->required;
    }

    /**
     * @param string $info
     */
    public function setInfo($info)
    {
        $this->info = $info ?: null;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name ?: null;
    }

    /**
     * @param bool $required
     */
    public function setRequired($required)
    {
        $this->required = (bool) $required;
    }

    /**
     * @param QuestionType $type
     */
    public function setType(QuestionType $type)
    {
        $this->type = $type;
    }
}
