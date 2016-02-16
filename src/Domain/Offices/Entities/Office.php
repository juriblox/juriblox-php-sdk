<?php

namespace JuriBlox\Sdk\Domain\Offices\Entities;

use JuriBlox\Sdk\Domain\Offices\Values\OfficeId;

class Office
{
    /**
     * @var OfficeId
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * Create an Office value object from raw text values
     *
     * @param   int     $id
     * @param   string  $name
     *
     * @return  Office
     */
    public static function fromText($id, $name)
    {
        return new static(new OfficeId($id), $name);
    }

    /**
     * @param $id
     * @param $name
     */
    public function __construct(OfficeId $id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getId();
    }

    /**
     * @return OfficeId
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}