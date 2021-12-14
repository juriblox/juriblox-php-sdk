<?php

namespace JuriBlox\Sdk\Domain\Customers\Values;

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class CustomerReferenceTest extends TestCase
{
    public function test_with_valid_data()
    {
        $uuid = Uuid::uuid1()->toString();

        $reference = new CustomerReference($uuid);

        $this->assertEquals($uuid, $reference->getString());
        $this->assertEquals($uuid, (string) $reference);
    }
}
