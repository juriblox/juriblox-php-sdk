<?php

namespace JuriBlox\Sdk\Domain\Offices\Entities;

use JuriBlox\Sdk\Domain\Offices\Values\OfficeId;

class OfficeTest extends \PHPUnit_Framework_TestCase
{
    const VALID_OFFICE_ID = 1;
    const VALID_OFFICE_NAME = 'JuriBlox';

    /**
     * @expectedException \JuriBlox\Sdk\Exceptions\AssertionFailedException
     */
    public function test_fromIdString_with_invalid_id()
    {
        Office::fromIdString('INVALID');
    }

    public function test_fromIdString_with_valid_id()
    {
        $office = Office::fromIdString(self::VALID_OFFICE_ID);

        $this->assertInstanceOf(OfficeId::class, $office->getId());
        $this->assertEquals(self::VALID_OFFICE_ID, $office->getId()->getId());
        $this->assertEquals(self::VALID_OFFICE_ID, (string) $office->getId());
    }

    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function test_fromId_with_invalid_id()
    {
        Office::fromId(new \stdClass());
    }

    public function test_fromId_with_valid_id()
    {
        $office = Office::fromId(new OfficeId(self::VALID_OFFICE_ID));

        $this->assertInstanceOf(OfficeId::class, $office->getId());
        $this->assertEquals(self::VALID_OFFICE_ID, $office->getId()->getId());
        $this->assertEquals(self::VALID_OFFICE_ID, (string) $office->getId());
    }

    public function test_with_valid_data()
    {
        $office = Office::fromIdString(self::VALID_OFFICE_ID);
        $office->setName(self::VALID_OFFICE_NAME);

        $this->assertEquals(self::VALID_OFFICE_NAME, $office->getName());
    }
}
