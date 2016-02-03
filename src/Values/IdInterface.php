<?php

namespace JuriBlox\Sdk\Values;

interface IdInterface
{
    /**
     * @param $id
     */
   function __construct($id);

    /**
     * @return string
     */
    function __toString();

    /**
     * @return string
     */
    function getId();
}