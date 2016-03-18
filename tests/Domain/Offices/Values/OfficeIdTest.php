<?php

namespace JuriBlox\Sdk\Domain\Offices\Values;

class OfficeIdTest extends \PHPUnit_Framework_TestCase
{
    const VALID_OFFICE_ID = 1;

    /**
     * @expectedException JuriBlox\Sdk\Exceptions\AssertionFailedException
     */
    public function test_with_invalid_id()
    {
        new OfficeId('INVALID');
    }

    public function test_with_valid_data()
    {
        $officeId = new OfficeId(self::VALID_OFFICE_ID);

        $this->assertEquals(self::VALID_OFFICE_ID, $officeId->getInteger());
        $this->assertEquals(self::VALID_OFFICE_ID, (string) $officeId);
    }
}
