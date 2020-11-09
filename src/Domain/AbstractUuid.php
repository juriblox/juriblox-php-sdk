<?php

namespace JuriBlox\Sdk\Domain;

use JuriBlox\Sdk\Validation\Assertion;

class AbstractUuid implements UuidInterface
{
    /**
     * @var string
     */
    private $uuid;
    
    /**
     * @param string $uuid
     */
    public function __construct($uuid)
    {
        Assertion::uuid($uuid);
        
        $this->uuid = $uuid;
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
        return $this->uuid;
    }
}