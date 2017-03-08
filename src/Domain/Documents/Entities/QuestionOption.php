<?php

namespace JuriBlox\Sdk\Domain\Documents\Entities;

use JuriBlox\Sdk\Domain\Documents\Values\QuestionOptionId;

class QuestionOption
{
    /**
     * @var QuestionOptionId
     */
    private $firstId;

    /**
     * ID.
     *
     * @var QuestionOptionId
     */
    private $id;

    /**
     * Position.
     *
     * @var int
     */
    private $position;

    /**
     * Title.
     *
     * @var string
     */
    private $title;

    /**
     * Value.
     *
     * @var mixed
     */
    private $value;

    /**
     * QuestionOption constructor.
     */
    private function __construct()
    {
        $this->position = -1;
    }

    /**
     * Create a QuestionOption entity based on an existing identity.
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
     * Create a QuestionOption entity based on an identity represented as a string.
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
     * @return QuestionOptionId
     */
    public function getFirstId(): QuestionOptionId
    {
        return $this->firstId;
    }

    /**
     * @return QuestionOptionId
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param QuestionOptionId $firstId
     */
    public function setFirstId(QuestionOptionId $firstId)
    {
        $this->firstId = $firstId;
    }

    /**
     * @param int $position
     */
    public function setPosition(int $position)
    {
        $this->position = $position;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = '' !== $title ? $title : null;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
