<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use JuriBlox\Sdk\Validation\Assertion;

class FileType
{
    /**
     * PDF file
     */
    const TYPE_PDF = 'PDF';

    /**
     * Word2007 file
     */
    const TYPE_WORD2007 = 'Word2007';

    /**
     * Supported file types
     *
     * @var array
     */
    public static $types = [
        self::TYPE_PDF          => 'PDF',
        self::TYPE_WORD2007     => 'Word 2007'
    ];

    /**
     * @var string
     */
    private $type;

    /**
     * FileType constructor
     *
     * @param $type
     */
    public function __construct($type)
    {
        Assertion::keyExists(static::$types, $type);

        $this->type = $type;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getType();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}