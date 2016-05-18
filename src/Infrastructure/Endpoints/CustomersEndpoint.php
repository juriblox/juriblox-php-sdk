<?php

namespace JuriBlox\Sdk\Infrastructure\Endpoints;

use JuriBlox\Sdk\Domain\Customers\Entities\Customer;
use JuriBlox\Sdk\Domain\Customers\Values\CustomerReference;
use JuriBlox\Sdk\Infrastructure\Collections\CustomersCollection;
use JuriBlox\Sdk\Infrastructure\Transformers\Customers\CustomerTransformer;
use Ramsey\Uuid\Uuid;

class CustomersEndpoint extends AbstractEndpoint implements EndpointInterface
{
    public function create(Customer $customer)
    {
        $customer->setReference(new CustomerReference(Uuid::uuid4()->toString()));

        $result = $this->driver->post('customers', CustomerTransformer::write($customer));

        return $customer;
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