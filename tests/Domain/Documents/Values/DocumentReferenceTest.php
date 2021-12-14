<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class DocumentReferenceTest extends TestCase
{
    public function test_with_valid_data()
    {
        $uuid = Uuid::uuid1()->toString();

        $reference = new DocumentReference($uuid);

        $this->assertEquals($uuid, $reference->getString());
        $this->assertEquals($uuid, (string) $reference);
    }
}
