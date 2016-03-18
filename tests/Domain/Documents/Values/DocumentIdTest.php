<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

class DocumentIdTest extends \PHPUnit_Framework_TestCase
{
    const VALID_DOCUMENT_ID = 1;

    /**
     * @expectedException JuriBlox\Sdk\Exceptions\AssertionFailedException
     */
    public function test_with_invalid_id()
    {
        new DocumentId('INVALID');
    }

    public function test_with_valid_data()
    {
        $documentId = new DocumentId(self::VALID_DOCUMENT_ID);

        $this->assertEquals(self::VALID_DOCUMENT_ID, $documentId->getInteger());
        $this->assertEquals(self::VALID_DOCUMENT_ID, (string) $documentId);
    }
}
