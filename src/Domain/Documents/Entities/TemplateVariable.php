<?php

namespace JuriBlox\Sdk\Domain\Documents\Entities;

use JuriBlox\Sdk\Domain\Documents\Values\TemplateVariableId;

class TemplateVariable
{
    /**
     * Variable ID
     *
     * @var TemplateVariableId
     */
    private $id;

    /**
     * Name (used in clauses)
     *
     * @var string
     */
    private $name;

    /**
     * Title
     *
     * @var string
     */
    private $title;

    /**
     * Description
     *
     * @var string
     */
    private $description;

    /**
     * Default value
     *
     * @var mixed
     */
    private $value;

    /**
     * Varifable constructor
     */
    private function __construct()
    {

    }

    /**
     * Create a variable entity based on an existing identity
     *
     * @param TemplateVariableId $id
     *
     * @return TemplateVariable
     */
    public static function fromId(TemplateVariableId $id)
    {
        $variable = new static();
        $variable->id = $id;

        return $variable;
    }

    /**
     * Create a variable entity based on an identity represented as a string
     *
     * @param string $id
     *
     * @return TemplateVariable
     */
    public static function fromIdString($id)
    {
        return static::fromId(new TemplateVariableId($id));
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return TemplateVariableId
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
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description ?: null;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name ?: null;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title ?: null;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value ?: null;
    }
}