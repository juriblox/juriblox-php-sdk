<?php

namespace JuriBlox\Sdk\Infrastructure\Transformers\Customers;

use JuriBlox\Sdk\Domain\Customers\Entities\Customer;
use JuriBlox\Sdk\Domain\Customers\Values\Contact;

class CustomerTransformer
{
    /**
     * Create a Customer from a DTO returned by the JuriBlox API
     *
     * @param $dto
     *
     * @return Customer
     */
    public static function read($dto)
    {
        $customer = Customer::fromReferenceString($dto->reference);
        $customer->setCompany($dto->company);
        $customer->setContact(new Contact($dto->contact->name, $dto->contact->email));

        return $customer;
    }

    /**
     * Generate a DTO from an existing Customer object
     *
     * @param Customer $customer
     *
     * @return array
     */
    public static function write(Customer $customer)
    {
        return [
            'reference'  => (!$customer->getReference()) ?: $customer->getReference()->getString(),

            'company'   => $customer->getCompany(),
            'name'      => $customer->getContact()->getName(),
            'email'     => $customer->getContact()->getEmail()
        ];
    }
}