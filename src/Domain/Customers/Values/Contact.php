<?php

namespace JuriBlox\Sdk\Domain\Customers\Values;

use JuriBlox\Sdk\Assertion;

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
     * CustomerContact constructor
     *
     * @param $name
     * @param $email
     */
    public function __construct($name, $email)
    {
        Assertion::email($email);

        $this->name = $name;
        $this->email = strtolower($email);
    }

    /**
     * @return string
     */
    public function __toString()
    {
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
}