<?php

namespace JuriBlox\Sdk\Domain;

interface ReferenceInterface
{
    /**
     * @param $reference
     */
    public function __construct($reference);

    /**
     * @return string
     */
    public function __toString();

    /**
     * @return string
     */
    public function getString();
}
