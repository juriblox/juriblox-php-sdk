<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

class QuestionOptionTest extends \PHPUnit_Framework_TestCase
{
    const VALID_OPTION_ID = 1;
    const VALID_OPTION_VALUE = 'Test option';

    /**
     * @expectedException JuriBlox\Sdk\Exceptions\AssertionFailedException
     */
    public function test_with_invalid_id()
    {
        new QuestionOption('INVALID', self::VALID_OPTION_VALUE);
    }

    public function test_with_valid_data()
    {
        $option = new QuestionOption(self::VALID_OPTION_ID, self::VALID_OPTION_VALUE);

        $this->assertEquals(self::VALID_OPTION_ID, $option->getId());
        $this->assertEquals(self::VALID_OPTION_ID, (string) $option);

        $this->assertEquals(self::VALID_OPTION_VALUE, $option->getValue());
    }
}