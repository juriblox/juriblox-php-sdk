<?php

namespace Tests\JuriBlox\Sdk\Values\Users;

use JuriBlox\Sdk\Values\Users\UserId;

class UserIdTest extends \PHPUnit_Framework_TestCase
{
    const VALID_USER_ID = 1;

    /**
     * @expectedException JuriBlox\Sdk\Exceptions\AssertionFailedException
     */
    public function test_with_invalid_id()
    {
        new UserId('INVALID');
    }

    public function test_with_valid_data()
    {
        $userId = new UserId(self::VALID_USER_ID);

        $this->assertEquals(self::VALID_USER_ID, $userId->getId());
        $this->assertEquals(self::VALID_USER_ID, (string) $userId);
    }
}
