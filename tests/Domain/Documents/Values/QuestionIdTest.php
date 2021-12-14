<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use JuriBlox\Sdk\Exceptions\AssertionFailedException;
use PHPUnit\Framework\TestCase;

class QuestionIdTest extends TestCase
{
    const VALID_QUESTION_ID = 1;

    public function test_with_valid_data()
    {
        $questionId = new QuestionId(self::VALID_QUESTION_ID);

        $this->assertEquals(self::VALID_QUESTION_ID, $questionId->getInteger());
        $this->assertEquals(self::VALID_QUESTION_ID, (string) $questionId);
    }

    public function test_with_invalid_id()
    {
        $this->expectException(AssertionFailedException::class);

        new DocumentId('INVALID');
    }
}
