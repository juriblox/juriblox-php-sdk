<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

class QuestionOptionCondition
{
    /**
     * Linked QuestionOptionId for this condition.
     *
     * @var QuestionOptionId
     */
    private $id;

    /**
     * QuestionCondition constructor.
     *
     * @param QuestionOptionId $id
     */
    public function __construct(QuestionOptionId $id)
    {
        $this->id = $id;
    }

    /**
     * @return QuestionOptionId
     */
    public function getId()
    {
        return $this->id;
    }
}
