<?php

namespace JuriBlox\Sdk\Values;

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
    function getReference();
}