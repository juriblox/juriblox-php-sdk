<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

class Definition
{
    /**
     * Description/explanation
     *
     * @var string
     */
    private $description;

    /**
     * Name (human-readable)
     *
     * @var string
     */
    private $name;

    /**
     * Visible
     *
     * @var bool
     */
    private $visible;

    /**
     * Definition constructor
     *
     * @param string $name
     * @param string $description
     * @param bool   $visible
     */
    public function __construct($name, $description, $visible)
    {
        $this->name = $name;
        $this->description = $description;
        $this->visible = (bool) $visible;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return boolean
     */
    public function isVisible()
    {
        return $this->visible;
    }
}