<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use JuriBlox\Sdk\Validation\Assertion;

class FileType
{
	/**
	 * ODT file.
	 */
	const TYPE_ODT = 'ODT';
	
    /**
     * PDF file.
     */
    const TYPE_PDF = 'PDF';

    /**
     * Word2007 file.
     */
    const TYPE_WORD2007 = 'Word2007';

    /**
     * File extensions.
     *
     * @var array
     */
    public static $extensions = [
        self::TYPE_ODT          => 'odt',
        self::TYPE_PDF          => 'pdf',
        self::TYPE_WORD2007     => 'docx',
    ];

    /**
     * Supported file types.
     *
     * @var array
     */
    public static $types = [
        self::TYPE_ODT          => 'ODT',
        self::TYPE_PDF          => 'PDF',
        self::TYPE_WORD2007     => 'Word 2007',
    ];

    /**
     * @var string
     */
    private $type;

    /**
     * FileType constructor.
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
    public function getExtension()
    {
        return self::$extensions[$this->type];
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
