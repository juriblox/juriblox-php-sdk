<?php

namespace JuriBlox\Sdk\Domain;

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
    function getInteger();
}