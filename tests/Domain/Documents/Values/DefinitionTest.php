<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use PHPUnit\Framework\TestCase;

class DefinitionTest extends TestCase
{
    const VALID_DEFINITION_NAME        = 'Parties';
    const VALID_DEFINITION_DESCRIPTION = 'The parties agreeing to the terms set out in this agreement';

    public function test_with_valid_data()
    {
        $definition = new Definition(self::VALID_DEFINITION_NAME, self::VALID_DEFINITION_DESCRIPTION, true);

        $this->assertEquals(self::VALID_DEFINITION_NAME, $definition->getName());
        $this->assertEquals(self::VALID_DEFINITION_DESCRIPTION, $definition->getDescription());
        $this->assertTrue($definition->isVisible());
    }

    public function test_with_trueish_visible_status()
    {
        $definition = new Definition(self::VALID_DEFINITION_NAME, self::VALID_DEFINITION_DESCRIPTION, 'foo');

        $this->assertTrue($definition->isVisible());
    }

    public function test_with_falshish_visible_status()
    {
        $definition = new Definition(self::VALID_DEFINITION_NAME, self::VALID_DEFINITION_DESCRIPTION, '');

        $this->assertFalse($definition->isVisible());
    }
}
