<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use JuriBlox\Sdk\Exceptions\AssertionFailedException;
use PHPUnit\Framework\TestCase;

class TagIdTest extends TestCase
{
    const VALID_TAG_ID = 1;

    public function test_with_invalid_id()
    {
        $this->expectException(AssertionFailedException::class);

        new TagId('INVALID');
    }

    public function test_with_valid_data()
    {
        $tagId = new TemplateId(self::VALID_TAG_ID);

        $this->assertEquals(self::VALID_TAG_ID, $tagId->getInteger());
        $this->assertEquals(self::VALID_TAG_ID, (string) $tagId);
    }
}
