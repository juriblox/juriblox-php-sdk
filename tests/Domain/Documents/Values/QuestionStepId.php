<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

class QuestionStepIdTest extends \PHPUnit_Framework_TestCase
{
    const VALID_STEP_ID = 1;

    /**
     * @expectedException \JuriBlox\Sdk\Exceptions\AssertionFailedException
     */
    public function test_with_invalid_id()
    {
        new QuestionStepId('INVALID');
    }

    public function test_with_valid_data()
    {
        $stepId = new QuestionStepId(self::VALID_STEP_ID);

        $this->assertEquals(self::VALID_STEP_ID, $stepId->getInteger());
        $this->assertEquals(self::VALID_STEP_ID, (string) $stepId);
    }
}
