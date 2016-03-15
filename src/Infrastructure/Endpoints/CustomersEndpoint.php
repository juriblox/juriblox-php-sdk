<?php

namespace JuriBlox\Sdk\Infrastructure\Endpoints;

use JuriBlox\Sdk\Domain\Customers\Entities\Customer;
use JuriBlox\Sdk\Infrastructure\Collections\CustomersCollection;

class CustomersEndpoint extends AbstractEndpoint implements EndpointInterface
{
    /**
     * Get all customers
     *
     * @return CustomersCollection|Customer[]
     */
    public function findAll()
    {
        return CustomersCollection::fromEndpoint($this);
    }
}