<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use JuriBlox\Sdk\Domain\IdInterface;
use JuriBlox\Sdk\Validation\Assertion;

class Revision
{
    /**
     * @var IdInterface
     */
    private $latestId;

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

        $this->latestId = $derivedOf;
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
     * @return IdInterface|TemplateId
     */
    public function getLatestId()
    {
        return $this->latestId;
    }

    /**
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
    }
}
