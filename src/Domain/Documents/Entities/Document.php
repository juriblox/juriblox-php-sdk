<?php

namespace JuriBlox\Sdk\Domain\Documents\Entities;

use JuriBlox\Sdk\Domain\Documents\Values\DocumentId;

class Document
{
    /**
     * Document ID
     *
     * @var DocumentId
     */
    private $id;

    /**
     * Document constructor
     */
    private function __construct()
    {

    }

    /**
     * Create a document entity based on an existing identity
     *
     * @param DocumentId $id
     *
     * @return Document
     */
    public static function fromId(DocumentId $id)
    {
        $document = new static();
        $document->id = $id;

        return $document;
    }

    /**
     * Create a document entity based on an identity represented as a string
     *
     * @param string $id
     *
     * @return Document
     */
    public static function fromIdString($id)
    {
        return static::fromId(new DocumentId($id));
    }
}