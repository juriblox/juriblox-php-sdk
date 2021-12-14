<?php

namespace JuriBlox\Sdk\Domain\Users\Entities;

use JuriBlox\Sdk\Domain\Users\Values\UserId;
use JuriBlox\Sdk\Exceptions\AssertionFailedException;
use PHPUnit\Framework\TestCase;
use TypeError;

class UserTest extends TestCase
{
    const VALID_USER_ID   = 1;
    const VALID_USER_NAME = 'John Doe';

    public function test_fromIdString_with_invalid_id()
    {
        $this->expectException(AssertionFailedException::class);

        User::fromIdString('INVALID');
    }

    public function test_fromIdString_with_valid_id()
    {
        $user = User::fromIdString(self::VALID_USER_ID);

        $this->assertInstanceOf(UserId::class, $user->getId());
        $this->assertEquals(self::VALID_USER_ID, $user->getId()->getInteger());
        $this->assertEquals(self::VALID_USER_ID, (string) $user->getId());
    }

    public function test_fromId_with_invalid_id()
    {
        $this->expectException(TypeError::class);

        User::fromId(new \stdClass());
    }

    public function test_fromId_with_valid_id()
    {
        $user = User::fromId(new UserId(self::VALID_USER_ID));

        $this->assertInstanceOf(UserId::class, $user->getId());
        $this->assertEquals(self::VALID_USER_ID, $user->getId()->getInteger());
        $this->assertEquals(self::VALID_USER_ID, (string) $user->getId());
    }

    public function test_with_valid_data()
    {
        $user = User::fromIdString(self::VALID_USER_ID);
        $user->setName(self::VALID_USER_NAME);

        $this->assertEquals(self::VALID_USER_NAME, $user->getName());
    }
}
