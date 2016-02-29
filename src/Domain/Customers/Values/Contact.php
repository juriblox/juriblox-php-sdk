<?php

namespace JuriBlox\Sdk\Domain\Customers\Values;

use JuriBlox\Sdk\Validation\Assertion;

class Contact
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $name;

    /**
     * Contact constructor
     *
     * @param $name
     * @param $email
     */
    public function __construct($name, $email = null)
    {
        $this->name = $name;
        $this->setEmail($email);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        if ($this->getEmail() === null)
        {
            return $this->getName();
        }

        return sprintf('%s <%s>', $this->getName(), $this->getEmail());
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        Assertion::nullOrEmail($email);

        $this->email = strtolower($email) ?: null;
    }
}