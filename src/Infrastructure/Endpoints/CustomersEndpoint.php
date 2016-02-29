<?php

namespace JuriBlox\Sdk\Infrastructure\Endpoints;

use JuriBlox\Sdk\Infrastructure\Collections\CustomersCollection;

class CustomersEndpoint extends AbstractEndpoint implements EndpointInterface
{
    /**
     * Get all customers
     *
     * @return CustomersCollection
     */
    public function findAll()
    {
        return CustomersCollection::fromEndpoint($this);
    }
}