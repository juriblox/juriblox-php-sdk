<?php

namespace Tests\JuriBlox\Sdk\Values\Documents;

use JuriBlox\Sdk\Values\Documents\DocumentId;
use JuriBlox\Sdk\Values\Documents\QuestionStepId;

class QuestionStepIdTest extends \PHPUnit_Framework_TestCase
{
    const VALID_STEP_ID = 1;

    /**
     * @expectedException JuriBlox\Sdk\Exceptions\AssertionFailedException
     */
    public function test_with_invalid_id()
    {
        new QuestionStepId('INVALID');
    }

    public function test_with_valid_data()
    {
        $stepId = new QuestionStepId(self::VALID_STEP_ID);

        $this->assertEquals(self::VALID_STEP_ID, $stepId->getId());
        $this->assertEquals(self::VALID_STEP_ID, (string) $stepId);
    }
}
