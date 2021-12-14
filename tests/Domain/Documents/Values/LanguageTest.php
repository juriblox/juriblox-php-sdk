<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use Assert\AssertionFailedException;
use PHPUnit\Framework\TestCase;

class LanguageTest extends TestCase
{
    const VALID_LANGUAGE_CODE = 'nl';
    const VALID_LANGUAGE_NAME = 'Nederlands';

    public function test_with_invalid_code()
    {
        $this->expectException(AssertionFailedException::class);

        new Language('INVALID', self::VALID_LANGUAGE_NAME);
    }

    public function test_with_valid_data()
    {
        $language = new Language(self::VALID_LANGUAGE_CODE, self::VALID_LANGUAGE_NAME);

        $this->assertEquals(self::VALID_LANGUAGE_CODE, $language->getCode());
        $this->assertEquals(self::VALID_LANGUAGE_CODE, (string) $language);

        $this->assertEquals(self::VALID_LANGUAGE_NAME, $language->getName());
    }
}
