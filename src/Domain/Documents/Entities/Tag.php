<?php

namespace JuriBlox\Sdk\Domain\Documents\Entities;

use JuriBlox\Sdk\Domain\Documents\Values\TagId;

class Tag
{
    /**
     * ID.
     *
     * @var TagId
     */
    private $id;

    /**
     * Name.
     *
     * @var string
     */
    private $name;

    /**
     * Tag constructor.
     */
    private function __construct()
    {
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * Create a tag entity based on an existing identity.
     *
     * @param TagId $id
     *
     * @return Tag
     */
    public static function fromId(TagId $id)
    {
        $tag = new static();
        $tag->id = $id;

        return $tag;
    }

    /**
     * Create a tag entity based on an identity represented as a string.
     *
     * @param string $id
     *
     * @return Tag
     */
    public static function fromIdString($id)
    {
        return static::fromId(new TagId($id));
    }

    /**
     * @return TagId
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
        $this->name = $name;
    }
}
