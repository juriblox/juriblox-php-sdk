<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use Ramsey\Uuid\Uuid;

class DocumentReferenceTest extends \PHPUnit_Framework_TestCase
{
    public function test_with_valid_data()
    {
        $uuid = Uuid::uuid1()->toString();

        $reference = new DocumentReference($uuid);

        $this->assertEquals($uuid, $reference->getReference());
        $this->assertEquals($uuid, (string) $reference);
    }
}
