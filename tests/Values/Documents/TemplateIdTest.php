<?php

namespace Tests\JuriBlox\Sdk\Values\Documents;

use JuriBlox\Sdk\Values\Documents\TemplateId;

class TemplateIdTest extends \PHPUnit_Framework_TestCase
{
    const VALID_TEMPLATE_ID = 1;

    /**
     * @expectedException JuriBlox\Sdk\Exceptions\AssertionFailedException
     */
    public function test_with_invalid_id()
    {
        new TemplateId('INVALID');
    }

    public function test_with_valid_data()
    {
        $templateId = new TemplateId(self::VALID_TEMPLATE_ID);

        $this->assertEquals(self::VALID_TEMPLATE_ID, $templateId->getId());
        $this->assertEquals(self::VALID_TEMPLATE_ID, (string) $templateId);
    }
}
