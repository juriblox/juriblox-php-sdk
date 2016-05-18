<?php

namespace JuriBlox\Sdk\Infrastructure\Collections;

use JuriBlox\Sdk\Domain\Customers\Entities\Customer;
use JuriBlox\Sdk\Infrastructure\Endpoints\CustomersEndpoint;
use JuriBlox\Sdk\Infrastructure\Transformers\Customers\CustomerTransformer;

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
        return CustomerTransformer::read($dto);
    }
}