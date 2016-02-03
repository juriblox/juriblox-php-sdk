<?php

namespace Tests\JuriBlox\Sdk\Values\Customers;

use JuriBlox\Sdk\Values\Customers\CustomerReference;
use Ramsey\Uuid\Uuid;

class CustomerReferenceTest extends \PHPUnit_Framework_TestCase
{
    public function test_with_valid_data()
    {
        $uuid = Uuid::uuid1()->toString();

        $reference = new CustomerReference($uuid);

        $this->assertEquals($uuid, $reference->getReference());
        $this->assertEquals($uuid, (string) $reference);
    }
}
