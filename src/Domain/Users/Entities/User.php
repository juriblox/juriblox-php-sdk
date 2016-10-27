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
     * Office constructor.
     */
    private function __construct()
    {
    }

    /**
     * @return string
     */
    public function __toString()
    {
        if ($this->name !== null) {
            return sprintf('%s (#%s)', $this->name, $this->id);
        }

        return '#' . $this->id;
    }

    /**
     * Create a User entity based on an existing identity.
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
     * Create a User entity based on an identity represented as a string.
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

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name ?: null;
    }
}
