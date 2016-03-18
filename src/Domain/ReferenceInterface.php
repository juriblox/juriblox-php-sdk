<?php

namespace JuriBlox\Sdk\Domain;

interface ReferenceInterface
{
    /**
     * @param $reference
     */
    function __construct($reference);

    /**
     * @return string
     */
    function __toString();

    /**
     * @return string
     */
    function getString();
}