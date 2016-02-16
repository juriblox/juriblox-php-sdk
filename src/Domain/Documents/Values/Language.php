<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

class Language
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * @param $code
     * @param $name
     */
    public function __construct($code, $name)
    {
        \Assert\that($code, 'The provided language code is invalid')->string()->length(2);

        $this->code = $code;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getCode();
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}