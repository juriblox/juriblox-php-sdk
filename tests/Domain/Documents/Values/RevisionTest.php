<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use PHPUnit\Framework\TestCase;
use TypeError;

class RevisionTest extends TestCase
{
    const VALID_REVISION_VERSION = 1;

    const VALID_TEMPLATE_ID = 100;

    public function test_with_invalid_derivedOf_object()
    {
        $this->expectException(TypeError::class);

        new Revision(new \stdClass(), self::VALID_REVISION_VERSION);
    }

    public function test_with_invalid_derivedOf_string()
    {
        $this->expectException(TypeError::class);

        new Revision('INVALID', self::VALID_REVISION_VERSION);
    }

    public function test_with_valid_data()
    {
        $templateId = new TemplateId(self::VALID_TEMPLATE_ID);

        $revision = new Revision($templateId, self::VALID_REVISION_VERSION);

        $this->assertEquals(self::VALID_REVISION_VERSION, $revision->getVersion());
        $this->assertEquals(self::VALID_REVISION_VERSION, (string) $revision);
    }
}
