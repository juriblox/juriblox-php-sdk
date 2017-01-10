<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

class TemplateIdTest extends \PHPUnit_Framework_TestCase
{
    const VALID_TEMPLATE_ID = 1;

    /**
     * @expectedException \JuriBlox\Sdk\Exceptions\AssertionFailedException
     */
    public function test_with_invalid_id()
    {
        new TemplateId('INVALID');
    }

    public function test_with_valid_data()
    {
        $templateId = new TemplateId(self::VALID_TEMPLATE_ID);

        $this->assertEquals(self::VALID_TEMPLATE_ID, $templateId->getInteger());
        $this->assertEquals(self::VALID_TEMPLATE_ID, (string) $templateId);
    }
}
