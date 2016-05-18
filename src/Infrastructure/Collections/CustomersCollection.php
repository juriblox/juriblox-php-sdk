<?php

namespace JuriBlox\Sdk\Infrastructure\Collections;

use JuriBlox\Sdk\Domain\Customers\Entities\Customer;
use JuriBlox\Sdk\Domain\Customers\Values\Contact;
use JuriBlox\Sdk\Infrastructure\Endpoints\CustomersEndpoint;
use JuriBlox\Sdk\Infrastructure\Factories\Customers\CustomerFactory;

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
        return CustomerFactory::createFromDto($dto);
    }
}