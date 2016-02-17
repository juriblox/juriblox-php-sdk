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
     * Create a User entity based on an existing identity
     *
     * @param UserId $id
     *
     * @return User
     */
    public static function fromId(UserId $id)
    {
        $user = new static();
        $user->id = $id;

        return $user;
    }

    /**
     * Create a User entity based on an identity represented as a string
     *
     * @param string $id
     *
     * @return User
     */
    public static function fromIdString($id)
    {
        return static::fromId(new UserId($id));
    }

    /**
     * Office constructor
     */
    private function __construct()
    {

    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name ?: null;
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