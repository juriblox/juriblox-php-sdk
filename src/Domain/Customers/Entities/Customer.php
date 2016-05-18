<?php

namespace JuriBlox\Sdk\Domain\Customers\Entities;

use JuriBlox\Sdk\Domain\Customers\Values\Contact;
use JuriBlox\Sdk\Domain\Customers\Values\CustomerReference;

class Customer
{
    /**
     * Company name
     *
     * @var string
     */
    private $company;

    /**
     * @var Contact
     */
    private $contact;

    /**
     * Customer reference
     *
     * @var CustomerReference
     */
    private $reference;

    /**
     * Customer constructor
     */
    public function __construct()
    {

    }

    /**
     * @return Contact|string
     */
    public function __toString()
    {
        if ($this->contact !== null)
        {
            $output = $this->contact;
            if ($this->company !== null)
            {
                $output .= sprintf(' (%s) [%s]', $this->company, $this->getReference()->getString());
            }
        }
        elseif ($this->company !== null)
        {
            $output = sprintf('%s [%s]', $this->company, $this->getReference()->getString());
        }
        else
        {
            $output = sprintf('[%s]', $this->getReference()->getString());
        }

        return $output;
    }

    /**
     * Create a customer entity based on an existing identity
     *
     * @param CustomerReference $reference
     *
     * @return Customer
     */
    public static function fromReference(CustomerReference $reference)
    {
        $customer = new static();
        $customer->reference = $reference;

        return $customer;
    }

    /**
     * Create a customer entity based on an existing identity
     *
     * @param string $reference
     *
     * @return Customer
     */
    public static function fromReferenceString($reference)
    {
        return static::fromReference(new CustomerReference($reference));
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @return Contact
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @return CustomerReference
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $company
     */
    public function setCompany($company)
    {
        $this->company = $company ?: null;
    }

    /**
     * @param Contact $contact
     */
    public function setContact(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * @param CustomerReference $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference ?: null;
    }
}