<?php

namespace JuriBlox\Sdk\Infrastructure\Endpoints;

use JuriBlox\Sdk\Domain\Customers\Entities\Customer;
use JuriBlox\Sdk\Domain\Customers\Values\CustomerReference;
use JuriBlox\Sdk\Infrastructure\Collections\CustomersCollection;
use JuriBlox\Sdk\Infrastructure\Transformers\Customers\CustomerTransformer;

class CustomersEndpoint extends AbstractEndpoint implements EndpointInterface
{
    /**
     * Create a remote Customer entity
     *
     * @param Customer $customer
     *
     * @return Customer
     */
    public function create(Customer $customer)
    {
        $result = $this->driver->post('customers', null, CustomerTransformer::write($customer));

        // Save UUID
        $customer->setReference(new CustomerReference($result->reference));

        return $customer;
    }

    public function update(Customer $customer)
    {
        $this->driver->patch('customers/{reference}', [
            'reference' => $customer->getReference()->getString()
        ], CustomerTransformer::write($customer));
    }

    /**
     * Get all customers
     *
     * @return CustomersCollection|Customer[]
     */
    public function findAll()
    {
        return CustomersCollection::fromEndpoint($this);
    }

    /**
     * Find a customer by reference
     *
     * @param CustomerReference $reference
     *
     * @return Customer
     */
    public function findOneByReference(CustomerReference $reference)
    {
        $result = $this->driver->get('customers/{reference}', [
            'reference' => $reference->getString()
        ]);

        return CustomerTransformer::read($result);
    }
}