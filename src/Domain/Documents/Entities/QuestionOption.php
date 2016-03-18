<?php

namespace JuriBlox\Sdk\Domain\Documents\Entities;

use JuriBlox\Sdk\Domain\Documents\Values\AnswerId;
use JuriBlox\Sdk\Domain\Documents\Values\QuestionAnswerId;
use JuriBlox\Sdk\Domain\Documents\Values\QuestionOptionId;

class QuestionOption
{
    /**
     * ID
     *
     * @var QuestionOptionId
     */
    private $id;

    /**
     * Value
     *
     * @var mixed
     */
    private $value;

    /**
     * Create a QuestionOption entity based on an existing identity
     *
     * @param QuestionOptionId $id
     *
     * @return QuestionOption
     */
    public static function fromId(QuestionOptionId $id)
    {
        $option = new static();
        $option->id = $id;

        return $option;
    }

    /**
     * Create a QuestionOption entity based on an identity represented as a string
     *
     * @param string $id
     *
     * @return QuestionOption
     */
    public static function fromIdString($id)
    {
        return static::fromId(new QuestionOptionId($id));
    }

    /**
     * QuestionOption constructor
     */
    private function __construct()
    {

    }

    /**
     * @return QuestionOptionId
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value ?: null;
    }
}