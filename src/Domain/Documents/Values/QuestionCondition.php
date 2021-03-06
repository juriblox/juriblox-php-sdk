<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

class QuestionCondition
{
    /**
     * Linked QuestionId for this condition.
     *
     * @var QuestionId
     */
    private $id;

    /**
     * QuestionCondition constructor.
     *
     * @param QuestionId $id
     */
    public function __construct(QuestionId $id)
    {
        $this->id = $id;
    }

    /**
     * @return QuestionId
     */
    public function getId()
    {
        return $this->id;
    }
}
