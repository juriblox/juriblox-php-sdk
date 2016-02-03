<?php

namespace Tests\JuriBlox\Sdk\Values\Documents;

use JuriBlox\Sdk\Values\Documents\File;
use JuriBlox\Sdk\Values\Documents\FileType;

class FileTest extends \PHPUnit_Framework_TestCase
{
    const VALID_FILE_FILENAME = 'filename.pdf';

    const VALID_FILE_TYPE = FileType::TYPE_PDF;

    const VALID_FILE_URL = 'http://api.juriblox.nl/document-download-url';

    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function test_constructor_with_invalid_file_type()
    {
        new File(self::VALID_FILE_URL, self::VALID_FILE_FILENAME, new \stdClass());
    }

    public function test_constructor_with_valid_data()
    {
        $type = new FileType(self::VALID_FILE_TYPE);

        $file = new File(self::VALID_FILE_URL, self::VALID_FILE_FILENAME, $type);

        $this->assertEquals(self::VALID_FILE_URL, $file->getUrl());
        $this->assertEquals(self::VALID_FILE_FILENAME, $file->getFilename());

        $this->assertInstanceOf(FileType::class, $file->getType());
        $this->assertEquals(self::VALID_FILE_TYPE, $file->getType()->getType());
        $this->assertEquals(self::VALID_FILE_TYPE, (string) $file->getType());
    }

    /**
     * @expectedException JuriBlox\Sdk\Exceptions\AssertionFailedException
     */
    public function test_fromText_with_invalid_file_type()
    {
        File::fromText(self::VALID_FILE_URL, self::VALID_FILE_FILENAME, 'INVALID');
    }

    /**
     * @expectedException JuriBlox\Sdk\Exceptions\AssertionFailedException
     */
    public function test_fromText_with_invalid_url()
    {
        File::fromText('INVALID', self::VALID_FILE_FILENAME, self::VALID_FILE_TYPE);
    }

    public function test_fromText_with_valid_data()
    {
        $file = File::fromText(self::VALID_FILE_URL, self::VALID_FILE_FILENAME, self::VALID_FILE_TYPE);

        $this->assertInstanceOf(File::class, $file);

        $this->assertEquals(self::VALID_FILE_URL, $file->getUrl());
        $this->assertEquals(self::VALID_FILE_FILENAME, $file->getFilename());

        $this->assertInstanceOf(FileType::class, $file->getType());
        $this->assertEquals(self::VALID_FILE_TYPE, $file->getType());
    }
}
