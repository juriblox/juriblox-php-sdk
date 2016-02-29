<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use JuriBlox\Sdk\Validation\Assertion;

class File
{
    /**
     * @var string
     */
    private $filename;

    /**
     * @var FileType
     */
    private $type;

    /**
     * @var string
     */
    private $url;

    /**
     * Create a File value object from raw text values (including $type)
     *
     * @param   string  $url
     * @param   string  $filename
     * @param   string  $type
     *
     * @return File
     */
    public static function fromText($url, $filename, $type)
    {
        return new static($url, $filename, new FileType($type));
    }

    /**
     * File constructor
     *
     * @param   string      $url
     * @param   string      $filename
     * @param   FileType    $type
     */
    public function __construct($url, $filename, FileType $type)
    {
        Assertion::url($url);

        $this->url = $url;
        $this->filename = $filename;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @return FileType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}