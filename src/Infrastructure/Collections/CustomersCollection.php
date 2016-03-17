<?php

namespace JuriBlox\Sdk\Infrastructure\Collections;

use JuriBlox\Sdk\Domain\Customers\Entities\Customer;
use JuriBlox\Sdk\Domain\Customers\Values\Contact;
use JuriBlox\Sdk\Infrastructure\Endpoints\CustomersEndpoint;

class CustomersCollection extends AbstractPagedCollection
{
    /**
     * @param CustomersEndpoint $endpoint
     *
     * @return CustomersCollection
     */
    public static function fromEndpoint(CustomersEndpoint $endpoint)
    {
        return static::fromEndpointWithSettings($endpoint, 'customers', 'customers');
    }

    /**
     * @param $dto
     *
     * @return Customer
     */
    protected function createEntityFromData($dto)
    {
        $customer = Customer::fromReferenceString($dto->reference);
        $customer->setCompany($dto->company);
        $customer->setContact(new Contact($dto->contact->name, $dto->contact->email));

        return $customer;
    }
}