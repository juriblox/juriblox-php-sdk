<?php

namespace JuriBlox\Sdk\Infrastructure\Endpoints;

use JuriBlox\Sdk\Infrastructure\Collections\CustomersCollection;

class CustomersEndpoint extends AbstractEndpoint
{
    /**
     * Alle customers
     *
     * @return CustomersCollection
     */
    public function getAll()
    {
        return CustomersCollection::fromDriver($this->driver);
    }
}