<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

class QuestionIdTest extends \PHPUnit_Framework_TestCase
{
    const VALID_QUESTION_ID = 1;

    public function test_with_valid_data()
    {
        $questionId = new QuestionId(self::VALID_QUESTION_ID);

        $this->assertEquals(self::VALID_QUESTION_ID, $questionId->getId());
        $this->assertEquals(self::VALID_QUESTION_ID, (string) $questionId);
    }

    /**
     * @expectedException JuriBlox\Sdk\Exceptions\AssertionFailedException
     */
    public function test_with_invalid_id()
    {
        new DocumentId('INVALID');
    }
}
