<?php

namespace JuriBlox\Sdk\Entities;

use JuriBlox\Sdk\Values\Customers\Contact;
use JuriBlox\Sdk\Values\Customers\CustomerReference;

class Customer
{
    /**
     * Customer reference
     *
     * @var CustomerReference
     */
    private $reference;

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
     * Customer constructor
     */
    private function __construct()
    {

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
}