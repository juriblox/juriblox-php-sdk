<?php

namespace JuriBlox\Sdk\Infrastructure\Factories\Customers;

use JuriBlox\Sdk\Domain\Customers\Entities\Customer;
use JuriBlox\Sdk\Domain\Customers\Values\Contact;

class CustomerFactory
{
    /**
     * Create a Customer from a DTO returned by the JuriBlox API
     *
     * @param $dto
     *
     * @return Customer
     */
    public static function createFromDto($dto)
    {
        $customer = Customer::fromReferenceString($dto->reference);
        $customer->setCompany($dto->company);
        $customer->setContact(new Contact($dto->contact->name, $dto->contact->email));

        return $customer;
    }
}