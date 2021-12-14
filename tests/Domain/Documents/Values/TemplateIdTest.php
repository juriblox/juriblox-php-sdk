<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use JuriBlox\Sdk\Exceptions\AssertionFailedException;
use PHPUnit\Framework\TestCase;

class TemplateIdTest extends TestCase
{
    const VALID_TEMPLATE_ID = 1;

    public function test_with_invalid_id()
    {
        $this->expectException(AssertionFailedException::class);

        new TemplateId('INVALID');
    }

    public function test_with_valid_data()
    {
        $templateId = new TemplateId(self::VALID_TEMPLATE_ID);

        $this->assertEquals(self::VALID_TEMPLATE_ID, $templateId->getInteger());
        $this->assertEquals(self::VALID_TEMPLATE_ID, (string) $templateId);
    }
}
