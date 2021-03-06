<?php

namespace JuriBlox\Sdk\Domain\Documents\Entities;

use JuriBlox\Sdk\Domain\Customers\Entities\Customer;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentId;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentReference;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentStatus;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentVariable;
use JuriBlox\Sdk\Domain\Documents\Values\File;
use JuriBlox\Sdk\Domain\Documents\Values\Language;
use JuriBlox\Sdk\Domain\Documents\Values\TemplateId;
use JuriBlox\Sdk\Domain\Offices\Entities\Office;

class Document
{
    /**
     * Alert date/time.
     *
     * @var \DateTime
     */
    private $alertDate;

    /**
     * Answers provided when generating this document.
     *
     * @var array
     */
    private $answers;

    /**
     * Creation date/time.
     *
     * @var \DateTime
     */
    private $createdDatetime;

    /**
     * Customer this document is for.
     *
     * @var Customer
     */
    private $customer;

    /**
     * Files generated for this document.
     *
     * @var array
     */
    private $files;

    /**
     * Document ID.
     *
     * @var DocumentId
     */
    private $id;

    /**
     * Document's language.
     *
     * @var Language
     */
    private $language;

    /**
     * Markdown.
     *
     * @var string
     */
    private $markdown;

    /**
     * Office this document belongs to.
     *
     * @var Office
     */
    private $office;

    /**
     * Reference.
     *
     * @var DocumentReference
     */
    private $reference;

    /**
     * Status.
     *
     * @var DocumentStatus
     */
    private $status;

    /**
     * Tags linked to this document.
     *
     * @var array
     */
    private $tags;

    /**
     * Template used to generate this document.
     *
     * @var TemplateId
     */
    private $templateId;

    /**
     * Title.
     *
     * @var string
     */
    private $title;

    /**
     * @var array|DocumentVariable[]
     */
    private $variables;

    /**
     * Document constructor.
     */
    private function __construct()
    {
        $this->clearAnswers();
        $this->clearFiles();
        $this->clearTags();
        $this->clearVariables();
    }

    /**
     * Create a document entity based on an existing identity.
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
     * Create a document entity based on an identity represented as a string.
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
     * Add an answer.
     *
     * @param QuestionAnswer $answer
     */
    public function addAnswer(QuestionAnswer $answer)
    {
        $this->answers[] = $answer;
    }

    /**
     * Add a linked file.
     *
     * @param File $file
     */
    public function addFile(File $file)
    {
        $this->files[] = $file;
    }

    /**
     * Add a linked tag.
     *
     * @param Tag $tag
     */
    public function addTag(Tag $tag)
    {
        $this->tags[] = $tag;
    }

    /**
     * @param DocumentVariable $variable
     */
    public function addVariable(DocumentVariable $variable)
    {
        $this->variables[] = $variable;
    }

    /**
     * Clear answers.
     */
    public function clearAnswers()
    {
        $this->answers = [];
    }

    /**
     * Clear generated files.
     */
    public function clearFiles()
    {
        $this->files = [];
    }

    /**
     * Clear linked tags.
     */
    public function clearTags()
    {
        $this->tags = [];
    }

    /**
     * Clear variables.
     */
    public function clearVariables()
    {
        $this->variables = [];
    }

    /**
     * @return \DateTime
     */
    public function getAlertDate()
    {
        return $this->alertDate;
    }

    /**
     * @return array|QuestionAnswer[]
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
     * @return array|File[]
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
     * @return string
     */
    public function getMarkdown()
    {
        return $this->markdown;
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
     * @return DocumentStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return array|Tag[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return TemplateId
     */
    public function getTemplateId()
    {
        return $this->templateId;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return array|DocumentVariable[]
     */
    public function getVariables(): array
    {
        return $this->variables;
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
     * @param string $markdown
     */
    public function setMarkdown($markdown)
    {
        $this->markdown = $markdown ?: null;
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
     * @param DocumentStatus $status
     */
    public function setStatus(DocumentStatus $status)
    {
        $this->status = $status;
    }

    /**
     * @param TemplateId $templateId
     */
    public function setTemplateId(TemplateId $templateId)
    {
        $this->templateId = $templateId;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
}
