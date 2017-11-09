<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use JuriBlox\Sdk\Validation\Assertion;

class DocumentVariable
{
    /**
     * @var TemplateVariableId|null
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var mixed
     */
    private $value;

    /**
     * Constructor.
     *
     */
    private function __construct()
    {
    }

    /**
     * @param TemplateVariableId $id
     * @param string             $name
     * @param                    $value
     *
     * @return DocumentVariable
     */
    public static function fromId(TemplateVariableId $id, string $name, $value)
    {
        $variable = new self();
        $variable->id = $id;
        $variable->name = $name;
        $variable->value = $value;

        return $variable;
    }

    /**
     * @param string $name
     * @param        $value
     *
     * @return DocumentVariable
     */
    public static function fromName(string $name, $value)
    {
        $variable = new self();
        $variable->name = $name;
        $variable->value = $value;

        return $variable;
    }

    /**
     * @return TemplateVariableId|null
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
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
