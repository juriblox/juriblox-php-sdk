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
     * Create an Office entity based on an existing identity
     *
     * @param OfficeId $id
     *
     * @return Office
     */
    public static function fromId(OfficeId $id)
    {
        $office = new static();
        $office->id = $id;

        return $office;
    }

    /**
     * Create a Office entity based on an identity represented as a string
     *
     * @param string $id
     *
     * @return Office
     */
    public static function fromIdString($id)
    {
        return static::fromId(new OfficeId($id));
    }

    /**
     * Office constructor
     */
    private function __construct()
    {

    }

    /**
     * @return string
     */
    public function __toString()
    {
        if ($this->name !== null)
        {
            return sprintf('%s (#%s)', $this->name, $this->id);
        }

        return '#' . $this->id;
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

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name ?: null;
    }
}