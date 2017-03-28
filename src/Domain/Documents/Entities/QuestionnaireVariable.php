<?php

namespace JuriBlox\Sdk\Domain\Documents\Entities;

class QuestionnaireVariable
{
    /**
     * Name.
     *
     * @var string
     */
    private $name;

    /**
     * Required yes/no.
     *
     * @var bool
     */
    private $required;

    /**
     * Type.
     *
     * @var string
     */
    private $type;

    /**
     * Varifable constructor.
     *
     * @param      $name
     * @param      $type
     * @param bool $required
     */
    private function __construct($name, $type, bool $required)
    {
        $this->name = $name;
        $this->type = $type;

        $this->required = $required;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @param      $name
     * @param      $type
     * @param bool $required
     *
     * @return QuestionnaireVariable
     */
    public static function create($name, $type, bool $required): QuestionnaireVariable
    {
        return new self($name, $type, $required);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
