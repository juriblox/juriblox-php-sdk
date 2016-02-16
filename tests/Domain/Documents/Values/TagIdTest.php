<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

class TagIdTest extends \PHPUnit_Framework_TestCase
{
    const VALID_TAG_ID = 1;

    /**
     * @expectedException JuriBlox\Sdk\Exceptions\AssertionFailedException
     */
    public function test_with_invalid_id()
    {
        new TagId('INVALID');
    }

    public function test_with_valid_data()
    {
        $tagId = new TemplateId(self::VALID_TAG_ID);

        $this->assertEquals(self::VALID_TAG_ID, $tagId->getId());
        $this->assertEquals(self::VALID_TAG_ID, (string) $tagId);
    }
}
