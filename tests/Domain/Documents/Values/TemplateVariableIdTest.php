<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use JuriBlox\Sdk\Exceptions\AssertionFailedException;
use PHPUnit\Framework\TestCase;

class TemplateVariableIdTest extends TestCase
{
    const VALID_VARIABLE_ID = 1;

    public function test_with_invalid_id()
    {
        $this->expectException(AssertionFailedException::class);

        new TemplateVariableId('INVALID');
    }

    public function test_with_valid_data()
    {
        $variableId = new TemplateVariableId(self::VALID_VARIABLE_ID);

        $this->assertEquals(self::VALID_VARIABLE_ID, $variableId->getInteger());
        $this->assertEquals(self::VALID_VARIABLE_ID, (string) $variableId);
    }
}
