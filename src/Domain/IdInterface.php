<?php

namespace JuriBlox\Sdk\Domain;

interface IdInterface
{
    /**
     * @param $id
     */
    public function __construct($id);

    /**
     * @return string
     */
    public function __toString();

    /**
     * @return int
     */
    public function getInteger();
}
