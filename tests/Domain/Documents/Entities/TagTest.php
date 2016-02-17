<?php

namespace JuriBlox\Sdk\Domain\Documents\Entities;

use JuriBlox\Sdk\Domain\Documents\Values\TagId;

class TagTest extends \PHPUnit_Framework_TestCase
{
    const VALID_TAG_ID = 1;
    const VALID_TAG_NAME = 'Foo';

    /**
     * @expectedException \JuriBlox\Sdk\Exceptions\AssertionFailedException
     */
    public function test_fromIdString_with_invalid_id()
    {
        Tag::fromIdString('INVALID');
    }

    public function test_fromIdString_with_valid_id()
    {
        $tag = Tag::fromIdString(self::VALID_TAG_ID);

        $this->assertInstanceOf(TagId::class, $tag->getId());
        $this->assertEquals(self::VALID_TAG_ID, $tag->getId()->getId());
        $this->assertEquals(self::VALID_TAG_ID, (string) $tag->getId());
    }

    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function test_fromId_with_invalid_id()
    {
        Tag::fromId(new \stdClass());
    }

    public function test_fromId_with_valid_id()
    {
        $tag = Tag::fromId(new TagId(self::VALID_TAG_ID));

        $this->assertInstanceOf(TagId::class, $tag->getId());
        $this->assertEquals(self::VALID_TAG_ID, $tag->getId()->getId());
        $this->assertEquals(self::VALID_TAG_ID, (string) $tag->getId());
    }

    public function test_with_valid_data()
    {
        $tag = Tag::fromIdString(self::VALID_TAG_ID);
        $tag->setName(self::VALID_TAG_NAME);

        $this->assertEquals(self::VALID_TAG_NAME, $tag->getName());
    }
}
