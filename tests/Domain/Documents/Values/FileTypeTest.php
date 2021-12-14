<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use JuriBlox\Sdk\Exceptions\AssertionFailedException;
use PHPUnit\Framework\TestCase;

class FileTypeTest extends TestCase
{
    public function availableTypesProvider()
    {
        $types = [];
        foreach (FileType::$types as $type => $name) {
            $types[] = [$type, $name];
        }

        return $types;
    }

    public function test_with_invalid_type()
    {
        $this->expectException(AssertionFailedException::class);

        new FileType('INVALID');
    }

    /**
     * @dataProvider availableTypesProvider
     *
     * @param string $typeText
     */
    public function test_with_valid_data($typeText)
    {
        $type = new FileType($typeText);

        $this->assertEquals($typeText, $type->getType());
        $this->assertEquals($typeText, (string) $type);
    }
}
