<?php

namespace Tests\JuriBlox\Sdk\Values\Documents;

use JuriBlox\Sdk\Values\Documents\FileType;

class FileTypeTest extends \PHPUnit_Framework_TestCase
{
    public function availableTypesProvider()
    {
        $types = [];
        foreach (FileType::$types as $type => $name)
        {
            $types[] = [$type, $name];
        }

        return $types;
    }

    /**
     * @expectedException JuriBlox\Sdk\Exceptions\AssertionFailedException
     */
    public function test_with_invalid_type()
    {
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
