<?php

namespace JuriBlox\Sdk\Domain;

use JuriBlox\Sdk\Validation\Assertion;

abstract class AbstractId implements IdInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @param $id
     */
    public function __construct($id)
    {
        Assertion::integerish($id);

        $this->id = $id;
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
}