<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use JuriBlox\Sdk\Exceptions\AssertionFailedException;
use PHPUnit\Framework\TestCase;

class QuestionStepIdTest extends TestCase
{
    const VALID_STEP_ID = 1;

    public function test_with_invalid_id()
    {
        $this->expectException(AssertionFailedException::class);

        new QuestionStepId('INVALID');
    }

    public function test_with_valid_data()
    {
        $stepId = new QuestionStepId(self::VALID_STEP_ID);

        $this->assertEquals(self::VALID_STEP_ID, $stepId->getInteger());
        $this->assertEquals(self::VALID_STEP_ID, (string) $stepId);
    }
}
