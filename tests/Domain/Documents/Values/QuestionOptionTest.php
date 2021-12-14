<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use JuriBlox\Sdk\Domain\Documents\Entities\QuestionOption;
use JuriBlox\Sdk\Exceptions\AssertionFailedException;
use PHPUnit\Framework\TestCase;

class QuestionOptionTest extends TestCase
{
    const VALID_OPTION_ID    = 1;
    const VALID_OPTION_VALUE = 'Test option';

    public function test_with_invalid_id()
    {
        $this->expectException(AssertionFailedException::class);

        QuestionOption::fromIdString('INVALID');
    }

    public function test_with_valid_data()
    {
        $option = QuestionOption::fromIdString(self::VALID_OPTION_ID);
        $option->setValue(self::VALID_OPTION_VALUE);

        $this->assertEquals(self::VALID_OPTION_ID, $option->getId()->getInteger());
        $this->assertEquals(self::VALID_OPTION_VALUE, $option->getValue());
    }
}
