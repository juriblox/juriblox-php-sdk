<?php

namespace JuriBlox\Sdk\Domain\Documents\Entities;

use JuriBlox\Sdk\Domain\Customers\Entities\Customer;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentId;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentReference;
use JuriBlox\Sdk\Domain\Documents\Values\Language;
use JuriBlox\Sdk\Domain\Offices\Entities\Office;

class Document
{
    /**
     * Alert date/time
     *
     * @var \DateTime
     */
    private $alertDate;

    /**
     * Answers provided when generating this document
     *
     * @var array
     */
    private $answers;

    /**
     * Creation date/time
     *
     * @var \DateTime
     */
    private $createdDatetime;

    /**
     * Customer this document is for
     *
     * @var Customer
     */
    private $customer;

    /**
     * Files generated for this document
     *
     * @var array
     */
    private $files;

    /**
     * Document ID
     *
     * @var DocumentId
     */
    private $id;

    /**
     * Document's language
     *
     * @var Language
     */
    private $language;

    /**
     * Office this document belongs to
     *
     * @var Office
     */
    private $office;

    /**
     * Reference
     *
     * @var DocumentReference
     */
    private $reference;

    /**
     * Tags linked to this document
     *
     * @var array
     */
    private $tags;

    /**
     * Title
     *
     * @var string
     */
    private $title;

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

    /**
     * Document constructor
     */
    private function __construct()
    {

    }
}