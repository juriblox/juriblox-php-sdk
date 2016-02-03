<?php

namespace JuriBlox\Sdk\Values;

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
        return (string) $this->getReference();
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }
}