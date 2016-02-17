<?php

namespace JuriBlox\Sdk\Domain\Documents\Entities;

use JuriBlox\Sdk\Domain\Customers\Entities\Customer;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentId;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentReference;
use JuriBlox\Sdk\Domain\Documents\Values\File;
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
        $this->clearFiles();
        $this->clearTags();
    }

    /**
     * Add a linked file
     *
     * @param File $file
     */
    public function addFile(File $file)
    {
        $this->files[] = $file;
    }

    /**
     * Add a linked tag
     *
     * @param Tag $tag
     */
    public function addTag(Tag $tag)
    {
        $this->tags[] = $tag;
    }

    /**
     * Clear generated files
     */
    public function clearFiles()
    {
        $this->files = [];
    }

    /**
     * Clear linked tags
     */
    public function clearTags()
    {
        $this->tags = [];
    }

    /**
     * @return \DateTime
     */
    public function getAlertDate()
    {
        return $this->alertDate;
    }

    /**
     * @return array
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedDatetime()
    {
        return $this->createdDatetime;
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @return DocumentId
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return Office
     */
    public function getOffice()
    {
        return $this->office;
    }

    /**
     * @return DocumentReference
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param \DateTime $alertDate
     */
    public function setAlertDate(\DateTime $alertDate)
    {
        $this->alertDate = $alertDate;
    }

    /**
     * @param array $answers
     */
    public function setAnswers($answers)
    {
        $this->answers = $answers;
    }

    /**
     * @param \DateTime $createdDatetime
     */
    public function setCreatedDatetime(\DateTime $createdDatetime)
    {
        $this->createdDatetime = $createdDatetime;
    }

    /**
     * @param Customer $customer
     */
    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * @param Language $language
     */
    public function setLanguage(Language $language)
    {
        $this->language = $language;
    }

    /**
     * @param Office $office
     */
    public function setOffice(Office $office)
    {
        $this->office = $office;
    }

    /**
     * @param DocumentReference $reference
     */
    public function setReference(DocumentReference $reference)
    {
        $this->reference = $reference;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
}