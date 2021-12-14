<?php

namespace JuriBlox\Sdk\Domain\Offices\Values;

use JuriBlox\Sdk\Exceptions\AssertionFailedException;
use PHPUnit\Framework\TestCase;

class OfficeIdTest extends TestCase
{
    const VALID_OFFICE_ID = 1;

    public function test_with_invalid_id()
    {
        $this->expectException(AssertionFailedException::class);

        new OfficeId('INVALID');
    }

    public function test_with_valid_data()
    {
        $officeId = new OfficeId(self::VALID_OFFICE_ID);

        $this->assertEquals(self::VALID_OFFICE_ID, $officeId->getInteger());
        $this->assertEquals(self::VALID_OFFICE_ID, (string) $officeId);
    }
}
