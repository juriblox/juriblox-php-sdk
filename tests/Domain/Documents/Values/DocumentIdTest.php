<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use JuriBlox\Sdk\Exceptions\AssertionFailedException;
use PHPUnit\Framework\TestCase;

class DocumentIdTest extends TestCase
{
    const VALID_DOCUMENT_ID = 1;

    public function test_with_invalid_id()
    {
        $this->expectException(AssertionFailedException::class);

        new DocumentId('INVALID');
    }

    public function test_with_valid_data()
    {
        $documentId = new DocumentId(self::VALID_DOCUMENT_ID);

        $this->assertEquals(self::VALID_DOCUMENT_ID, $documentId->getInteger());
        $this->assertEquals(self::VALID_DOCUMENT_ID, (string) $documentId);
    }
}
