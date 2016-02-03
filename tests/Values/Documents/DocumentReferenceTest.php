<?php

namespace Tests\JuriBlox\Sdk\Values\Documents;

use JuriBlox\Sdk\Values\Documents\DocumentReference;
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
