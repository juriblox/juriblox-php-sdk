<?php

namespace JuriBlox\Sdk\Domain\Users\Entities;

use JuriBlox\Sdk\Domain\Users\Values\UserId;

class UserTest extends \PHPUnit_Framework_TestCase
{
    const VALID_USER_ID = 1;
    const VALID_USER_NAME = 'John Doe';

    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function test_constructor_with_invalid_id()
    {
        new User(new \stdClass(), self::VALID_USER_NAME);
    }

    public function test_constructor_with_valid_data()
    {
        $userId = new UserId(self::VALID_USER_ID);

        $user = new User($userId, self::VALID_USER_NAME);

        $this->assertInstanceOf(UserId::class, $user->getId());
        $this->assertEquals(self::VALID_USER_ID, $user->getId()->getId());
        $this->assertEquals(self::VALID_USER_ID, (string) $user->getId());

        $this->assertEquals(self::VALID_USER_NAME, $user->getName());
    }

    /**
     * @expectedException JuriBlox\Sdk\Exceptions\AssertionFailedException
     */
    public function test_fromText_with_invalid_id()
    {
        User::fromText('INVALID', self::VALID_USER_NAME);
    }

    public function test_fromText_with_valid_data()
    {
        $user = User::fromText(self::VALID_USER_ID, self::VALID_USER_NAME);

        $this->assertInstanceOf(UserId::class, $user->getId());
        $this->assertEquals(self::VALID_USER_ID, $user->getId()->getId());
        $this->assertEquals(self::VALID_USER_ID, (string) $user->getId());

        $this->assertEquals(self::VALID_USER_NAME, $user->getName());
    }
}
