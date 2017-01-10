<?php

namespace JuriBlox\Sdk\Domain\Users\Values;

class UserIdTest extends \PHPUnit_Framework_TestCase
{
    const VALID_USER_ID = 1;

    /**
     * @expectedException \JuriBlox\Sdk\Exceptions\AssertionFailedException
     */
    public function test_with_invalid_id()
    {
        new UserId('INVALID');
    }

    public function test_with_valid_data()
    {
        $userId = new UserId(self::VALID_USER_ID);

        $this->assertEquals(self::VALID_USER_ID, $userId->getInteger());
        $this->assertEquals(self::VALID_USER_ID, (string) $userId);
    }
}
