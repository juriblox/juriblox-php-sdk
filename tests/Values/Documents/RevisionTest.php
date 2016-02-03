<?php

namespace Tests\JuriBlox\Sdk\Values\Documents;

use JuriBlox\Sdk\Values\Documents\Revision;
use JuriBlox\Sdk\Values\Documents\TemplateId;

class RevisionTest extends \PHPUnit_Framework_TestCase
{
    const VALID_REVISION_VERSION = 1;

    const VALID_TEMPLATE_ID = 100;

    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function test_with_invalid_derivedOf_object()
    {
        new Revision(new \stdClass(), self::VALID_REVISION_VERSION);
    }

    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function test_with_invalid_derivedOf_string()
    {
        new Revision('INVALID', self::VALID_REVISION_VERSION);
    }

    public function test_with_valid_data()
    {
        $templateId = new TemplateId(self::VALID_TEMPLATE_ID);

        $revision = new Revision($templateId, self::VALID_REVISION_VERSION);

        $this->assertInstanceOf(TemplateId::class, $revision->getDerivedOf());

        $this->assertEquals(self::VALID_TEMPLATE_ID, $revision->getDerivedOf()->getId());
        $this->assertEquals(self::VALID_TEMPLATE_ID, (string) $revision->getDerivedOf());

        $this->assertEquals(self::VALID_REVISION_VERSION, $revision->getVersion());
    }
}
