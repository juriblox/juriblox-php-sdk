<?php

namespace JuriBlox\Sdk\Domain\Users\Values;

use JuriBlox\Sdk\Exceptions\AssertionFailedException;
use PHPUnit\Framework\TestCase;

class UserIdTest extends TestCase
{
    const VALID_USER_ID = 1;

    public function test_with_invalid_id()
    {
        $this->expectException(AssertionFailedException::class);

        new UserId('INVALID');
    }

    public function test_with_valid_data()
    {
        $userId = new UserId(self::VALID_USER_ID);

        $this->assertEquals(self::VALID_USER_ID, $userId->getInteger());
        $this->assertEquals(self::VALID_USER_ID, (string) $userId);
    }
}
