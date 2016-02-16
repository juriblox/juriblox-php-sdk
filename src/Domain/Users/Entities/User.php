<?php

namespace JuriBlox\Sdk\Domain\Users\Entities;

use JuriBlox\Sdk\Domain\Users\Values\UserId;

class User
{
    /**
     * @var UserId
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * Create a User value object from raw text values
     *
     * @param   int     $id
     * @param   string  $name
     *
     * @return  User
     */
    public static function fromText($id, $name)
    {
        return new static(new UserId($id), $name);
    }

    /**
     * @param $id
     * @param $name
     */
    public function __construct(UserId $id, $name)
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
     * @return UserId
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