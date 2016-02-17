<?php

namespace JuriBlox\Sdk\Domain\Users\Entities;

use JuriBlox\Sdk\Domain\Users\Values\UserId;

class UserTest extends \PHPUnit_Framework_TestCase
{
    const VALID_USER_ID = 1;
    const VALID_USER_NAME = 'John Doe';

    /**
     * @expectedException \JuriBlox\Sdk\Exceptions\AssertionFailedException
     */
    public function test_fromIdString_with_invalid_id()
    {
        User::fromIdString('INVALID');
    }

    public function test_fromIdString_with_valid_id()
    {
        $user = User::fromIdString(self::VALID_USER_ID);

        $this->assertInstanceOf(UserId::class, $user->getId());
        $this->assertEquals(self::VALID_USER_ID, $user->getId()->getId());
        $this->assertEquals(self::VALID_USER_ID, (string) $user->getId());
    }

    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function test_fromId_with_invalid_id()
    {
        User::fromId(new \stdClass());
    }

    public function test_fromId_with_valid_id()
    {
        $user = User::fromId(new UserId(self::VALID_USER_ID));

        $this->assertInstanceOf(UserId::class, $user->getId());
        $this->assertEquals(self::VALID_USER_ID, $user->getId()->getId());
        $this->assertEquals(self::VALID_USER_ID, (string) $user->getId());
    }

    public function test_with_valid_data()
    {
        $user = User::fromIdString(self::VALID_USER_ID);
        $user->setName(self::VALID_USER_NAME);

        $this->assertEquals(self::VALID_USER_NAME, $user->getName());
    }
}
