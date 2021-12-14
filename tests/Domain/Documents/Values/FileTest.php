<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use JuriBlox\Sdk\Exceptions\AssertionFailedException;
use PHPUnit\Framework\TestCase;
use TypeError;

class FileTest extends TestCase
{
    const VALID_FILE_FILENAME = 'filename.pdf';

    const VALID_FILE_TYPE = FileType::TYPE_PDF;

    const VALID_FILE_URL = 'http://api.juriblox.nl/document-download-url';

    public function test_constructor_with_invalid_file_type()
    {
        $this->expectException(TypeError::class);

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

    public function test_fromText_with_invalid_file_type()
    {
        $this->expectException(AssertionFailedException::class);

        File::fromText(self::VALID_FILE_URL, self::VALID_FILE_FILENAME, 'INVALID');
    }

    public function test_fromText_with_invalid_url()
    {
        $this->expectException(AssertionFailedException::class);

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
