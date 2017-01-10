<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

class QuestionTypeTest extends \PHPUnit_Framework_TestCase
{
    public function availableTypesProvider()
    {
        $types = [];
        foreach (QuestionType::$types as $code => $name) {
            $types[] = [$code, $name];
        }

        return $types;
    }

    /**
     * @expectedException \JuriBlox\Sdk\Exceptions\AssertionFailedException
     */
    public function test_with_invalid_type()
    {
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
