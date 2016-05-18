<?php

namespace JuriBlox\Sdk\Infrastructure\Endpoints;

use JuriBlox\Sdk\Domain\Customers\Entities\Customer;
use JuriBlox\Sdk\Domain\Customers\Values\CustomerReference;
use JuriBlox\Sdk\Infrastructure\Collections\CustomersCollection;
use JuriBlox\Sdk\Infrastructure\Factories\Customers\CustomerFactory;

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

    public function findOneByReference(CustomerReference $reference)
    {
        $result = $this->driver->get('customers/{reference}', [
            'reference' => $reference->getString()
        ]);

        return CustomerFactory::createFromDto($result);
    }
}