<?php

namespace JuriBlox\Sdk\Domain\Offices\Entities;

use JuriBlox\Sdk\Domain\Offices\Values\OfficeId;
use JuriBlox\Sdk\Exceptions\AssertionFailedException;
use PHPUnit\Framework\TestCase;
use TypeError;

class OfficeTest extends TestCase
{
    const VALID_OFFICE_ID   = 1;
    const VALID_OFFICE_NAME = 'JuriBlox';

    public function test_fromIdString_with_invalid_id()
    {
        $this->expectException(AssertionFailedException::class);

        Office::fromIdString('INVALID');
    }

    public function test_fromIdString_with_valid_id()
    {
        $office = Office::fromIdString(self::VALID_OFFICE_ID);

        $this->assertInstanceOf(OfficeId::class, $office->getId());
        $this->assertEquals(self::VALID_OFFICE_ID, $office->getId()->getInteger());
        $this->assertEquals(self::VALID_OFFICE_ID, (string) $office->getId());
    }

    public function test_fromId_with_invalid_id()
    {
        $this->expectException(TypeError::class);

        Office::fromId(new \stdClass());
    }

    public function test_fromId_with_valid_id()
    {
        $office = Office::fromId(new OfficeId(self::VALID_OFFICE_ID));

        $this->assertInstanceOf(OfficeId::class, $office->getId());
        $this->assertEquals(self::VALID_OFFICE_ID, $office->getId()->getInteger());
        $this->assertEquals(self::VALID_OFFICE_ID, (string) $office->getId());
    }

    public function test_with_valid_data()
    {
        $office = Office::fromIdString(self::VALID_OFFICE_ID);
        $office->setName(self::VALID_OFFICE_NAME);

        $this->assertEquals(self::VALID_OFFICE_NAME, $office->getName());
    }
}
