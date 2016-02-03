<?php

namespace JuriBlox\Sdk\Infrastructure\Collections;

use JuriBlox\Sdk\Entities\Customer;
use JuriBlox\Sdk\Infrastructure\Drivers\DriverInterface;
use JuriBlox\Sdk\Values\Customers\Contact;

class CustomersCollection extends AbstractCollection
{
    /**
     * @param DriverInterface $driver
     *
     * @return CustomersCollection
     */
    public static function fromDriver(DriverInterface $driver)
    {
        return static::fromDriverWithSettings($driver, 'customers', 'customers');
    }

    /**
     * @param $dto
     *
     * @return Customer
     */
    public function createEntityFromData($dto)
    {
        $customer = Customer::fromReferenceString($dto->reference);
        $customer->setCompany($dto->company);
        $customer->setContact(new Contact($dto->contact->name, $dto->contact->email));

        return $customer;
    }
}