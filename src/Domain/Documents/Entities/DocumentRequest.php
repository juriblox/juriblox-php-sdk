<?php

namespace JuriBlox\Sdk\Domain\Documents\Entities;

use JuriBlox\Sdk\Domain\Customers\Values\CustomerReference;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentReference;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentRequestId;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentStatus;
use JuriBlox\Sdk\Domain\Documents\Values\TemplateId;
use JuriBlox\Sdk\Validation\Assertion;

class DocumentRequest
{
    /**
     * Alert date.
     *
     * @var \DateTime
     */
    private $alertDate;

    /**
     * Answer.
     *
     * @var array|QuestionAnswer[]
     */
    private $answers;

    /**
     * Customer.
     *
     * @var CustomerReference
     */
    private $customer;

    /**
     * ID.
     *
     * @var DocumentRequestId
     */
    private $id;

    /**
     * Reference.
     *
     * @var DocumentReference
     */
    private $reference;

    /**
     * Remarks.
     *
     * @var string
     */
    private $remarks;

    /**
     * Status.
     *
     * @var DocumentStatus
     */
    private $status;

    /**
     * Template.
     *
     * @var TemplateId
     */
    private $templateId;

    /**
     * Template version.
     *
     * @var int
     */
    private $templateVersion;

    /**
     * Document title.
     *
     * @var string
     */
    private $title;

    /**
     * @var array
     */
    private $variables;

    /**
     * DocumentRequest constructor.
     */
    private function __construct()
    {
        $this->clearAnswers();
        $this->clearVariables();
    }

    /**
     * Create a DocumentRequest entity based on an existing identity.
     *
     * @param DocumentRequestId $id
     *
     * @return DocumentRequest
     */
    public static function fromId(DocumentRequestId $id)
    {
        $request = new static();
        $request->id = $id;

        return $request;
    }

    /**
     * Create a DocumentRequest entity based on an identity represented as a string.
     *
     * @param string $id
     *
     * @return DocumentRequest
     */
    public static function fromIdString($id)
    {
        return static::fromId(new DocumentRequestId($id));
    }

    /**
     * Prepare a document generation request.
     *
     * @param TemplateId $templateId
     *
     * @return DocumentRequest
     */
    public static function prepare(TemplateId $templateId)
    {
        $request = new static();
        $request->templateId = $templateId;

        return $request;
    }

    /**
     * @param QuestionAnswer $answer
     */
    public function addAnswer(QuestionAnswer $answer)
    {
        $this->answers[] = $answer;
    }

    /**
     * Clear the answers.
     */
    public function clearAnswers()
    {
        $this->answers = [];
    }

    /**
     * Clear the variables.
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
     * @return CustomerReference
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @return DocumentRequestId
     */
    public function getId()
    {
        return $this->id;
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
    public function getRemarks()
    {
        return $this->remarks;
    }

    /**
     * @return DocumentStatus
     */
    public function getStatus()
    {
        return $this->status;
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
     * @return array
     */
    public function getVariables(): array
    {
        return $this->variables;
    }

    /**
     * @param \DateTime|null $alertDate
     */
    public function setAlertDate($alertDate)
    {
        Assertion::nullOrIsInstanceOf($alertDate, \DateTime::class);

        $this->alertDate = $alertDate;
    }

    /**
     * @param CustomerReference|null $customer
     */
    public function setCustomer($customer)
    {
        Assertion::nullOrIsInstanceOf($customer, CustomerReference::class);

        $this->customer = $customer;
    }

    /**
     * @param DocumentRequestId $id
     */
    public function setId(DocumentRequestId $id)
    {
        $this->id = $id;
    }

    /**
     * @param DocumentReference|null $reference
     */
    public function setReference($reference)
    {
        Assertion::nullOrIsInstanceOf($reference, DocumentReference::class);

        $this->reference = $reference;
    }

    /**
     * @param string $remarks
     */
    public function setRemarks($remarks)
    {
        $this->remarks = $remarks ?: null;
    }

    /**
     * @param DocumentStatus $status
     */
    public function setStatus(DocumentStatus $status)
    {
        $this->status = $status;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title ?: null;
    }

    /**
     * @param $name
     * @param $value
     */
    public function setVariable($name, $value)
    {
        $this->variables[$name] = $value;
    }

    /**
     * @return int
     */
    public function getTemplateVersion()
    {
        return $this->templateVersion;
    }

    /**
     * @param int $templateVersion
     */
    public function setTemplateVersion($templateVersion)
    {
        $this->templateVersion = $templateVersion;
    }
}
