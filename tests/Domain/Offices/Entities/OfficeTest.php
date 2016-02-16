<?php

namespace JuriBlox\Sdk\Domain\Offices\Entities;

use JuriBlox\Sdk\Domain\Offices\Values\OfficeId;

class OfficeTest extends \PHPUnit_Framework_TestCase
{
    const VALID_OFFICE_ID = 1;
    const VALID_OFFICE_NAME = 'JuriBlox';

    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function test_constructor_with_invalid_id()
    {
        new Office(new \stdClass(), self::VALID_OFFICE_NAME);
    }

    public function test_constructor_with_valid_data()
    {
        $officeId = new OfficeId(self::VALID_OFFICE_ID);

        $office = new Office($officeId, self::VALID_OFFICE_NAME);

        $this->assertInstanceOf(OfficeId::class, $office->getId());
        $this->assertEquals(self::VALID_OFFICE_ID, $office->getId()->getId());
        $this->assertEquals(self::VALID_OFFICE_ID, (string) $office->getId());

        $this->assertEquals(self::VALID_OFFICE_NAME, $office->getName());
    }

    /**
     * @expectedException JuriBlox\Sdk\Exceptions\AssertionFailedException
     */
    public function test_fromText_with_invalid_id()
    {
        Office::fromText('INVALID', self::VALID_OFFICE_NAME);
    }

    public function test_fromText_with_valid_data()
    {
        $office = Office::fromText(self::VALID_OFFICE_ID, self::VALID_OFFICE_NAME);

        $this->assertInstanceOf(OfficeId::class, $office->getId());
        $this->assertEquals(self::VALID_OFFICE_ID, $office->getId()->getId());
        $this->assertEquals(self::VALID_OFFICE_ID, (string) $office->getId());

        $this->assertEquals(self::VALID_OFFICE_NAME, $office->getName());
    }
}
