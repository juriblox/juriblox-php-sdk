<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use JuriBlox\Sdk\Exceptions\AssertionFailedException;
use PHPUnit\Framework\TestCase;

class QuestionTypeTest extends TestCase
{
    public function availableTypesProvider()
    {
        $types = [];
        foreach (QuestionType::$types as $code => $name) {
            $types[] = [$code, $name];
        }

        return $types;
    }

    public function test_with_invalid_type()
    {
        $this->expectException(AssertionFailedException::class);

        new QuestionType('INVALID');
    }

    /**
     * @dataProvider availableTypesProvider
     *
     * @param string $typeText
     */
    public function test_with_valid_data($typeText)
    {
        $type = new QuestionType($typeText);

        $this->assertEquals($typeText, $type->getType());
        $this->assertEquals($typeText, (string) $type);
    }
}
