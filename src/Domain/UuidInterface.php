<?php


namespace JuriBlox\Sdk\Domain;

interface UuidInterface
{
    /**
     * @param $uuid
     */
    public function __construct($uuid);
    
    /**
     * @return string
     */
    public function __toString();
    
    /**
     * @return string
     */
    public function getString();
}