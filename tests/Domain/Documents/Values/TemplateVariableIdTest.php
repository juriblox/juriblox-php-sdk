<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

class TemplateVariableIdTest extends \PHPUnit_Framework_TestCase
{
    const VALID_VARIABLE_ID = 1;

    /**
     * @expectedException \JuriBlox\Sdk\Exceptions\AssertionFailedException
     */
    public function test_with_invalid_id()
    {
        new TemplateVariableId('INVALID');
    }

    public function test_with_valid_data()
    {
        $variableId = new TemplateVariableId(self::VALID_VARIABLE_ID);

        $this->assertEquals(self::VALID_VARIABLE_ID, $variableId->getInteger());
        $this->assertEquals(self::VALID_VARIABLE_ID, (string) $variableId);
    }
}
