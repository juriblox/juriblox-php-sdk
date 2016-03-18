<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

class QuestionCondition
{
    /**
     * Linked QuestionOptionId for this condition
     *
     * @var QuestionOptionId
     */
    private $id;

    /**
     * Desired value
     *
     * @var mixed
     */
    private $value;

    /**
     * QuestionCondition constructor
     *
     * @param QuestionOptionId $id
     * @param                  $value
     */
    public function __construct(QuestionOptionId $id, $value)
    {
        $this->id = $id;
        $this->value = $value;
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
     * @param QuestionOptionId $id
     */
    public function setId(QuestionOptionId $id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value ?: null;
    }
}