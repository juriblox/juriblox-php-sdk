<?php

namespace JuriBlox\Sdk\Infrastructure\Collections;

use JuriBlox\Sdk\Domain\Customers\Entities\Customer;
use JuriBlox\Sdk\Domain\Customers\Values\Contact;
use JuriBlox\Sdk\Infrastructure\Endpoints\EndpointInterface;

class CustomersCollection extends AbstractPagedCollection
{
    /**
     * @param EndpointInterface $endpoint
     *
     * @return CustomersCollection
     */
    public static function fromEndpoint($endpoint)
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