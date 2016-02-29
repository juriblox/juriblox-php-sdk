<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use JuriBlox\Sdk\Validation\Assertion;

class QuestionOption
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var mixed
     */
    private $value;

    /**
     * @param $id
     * @param $name
     */
    public function __construct($id, $name)
    {
        Assertion::integerish($id);

        $this->id = $id;
        $this->value = $name;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getId();
    }

    /**
     * @return int
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
}