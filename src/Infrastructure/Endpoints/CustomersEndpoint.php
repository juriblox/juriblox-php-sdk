<?php

namespace JuriBlox\Sdk\Infrastructure\Endpoints;

use JuriBlox\Sdk\Infrastructure\Collections\CustomersCollection;

class CustomersEndpoint extends AbstractEndpoint
{
    /**
     * Get all customers
     *
     * @return CustomersCollection
     */
    public function findAll()
    {
        return CustomersCollection::fromDriver($this->driver);
    }
}