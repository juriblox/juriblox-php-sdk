<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use JuriBlox\Sdk\Domain\IdInterface;
use JuriBlox\Sdk\Validation\Assertion;

class Revision
{
    /**
     * @var IdInterface
     */
    private $derivedOf;

    /**
     * @var int
     */
    private $version;

    /**
     * @param IdInterface $derivedOf
     * @param int         $version
     */
    public function __construct(IdInterface $derivedOf, $version)
    {
        Assertion::integerish($version);

        $this->derivedOf = $derivedOf;
        $this->version = $version;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getVersion();
    }

    /**
     * @return IdInterface
     */
    public function getDerivedOf()
    {
        return $this->derivedOf;
    }

    /**
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
    }
}
