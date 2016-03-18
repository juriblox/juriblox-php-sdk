<?php

namespace JuriBlox\Sdk\Domain;

abstract class AbstractReference implements ReferenceInterface
{
    /**
     * @var string
     */
    private $reference;

    /**
     * @param $reference
     */
    public function __construct($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getString();
    }

    /**
     * @return string
     */
    public function getString()
    {
        return $this->reference;
    }
}