<?php

namespace JuriBlox\Sdk\Domain\Documents\Entities;

use JuriBlox\Sdk\Domain\Customers\Entities\Customer;
use JuriBlox\Sdk\Domain\Customers\Values\CustomerReference;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentReference;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentStatus;
use JuriBlox\Sdk\Domain\Documents\Values\TemplateId;
use JuriBlox\Sdk\Validation\Assertion;

class DocumentRequest
{
    /**
     * Alert date
     *
     * @var \DateTime
     */
    private $alertDate;

    /**
     * Answer
     *
     * @var array|QuestionAnswer[]
     */
    private $answers;

    /**
     * Customer
     *
     * @var CustomerReference
     */
    private $customer;

    /**
     * Reference
     *
     * @var DocumentReference
     */
    private $reference;

    /**
     * Remarks
     *
     * @var string
     */
    private $remarks;

    /**
     * Template
     *
     * @var TemplateId
     */
    private $templateId;

    /**
     * Document title
     *
     * @var string
     */
    private $title;

    /**
     * Prepare a document generation request
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
     * DocumentRequest constructor
     */
    private function __construct()
    {
        $this->clearAnswers();
    }

    /**
     * @param QuestionAnswer $answer
     */
    public function addAnswer(QuestionAnswer $answer)
    {
        $this->answers[] = $answer;
    }

    /**
     * Clear the answers
     */
    public function clearAnswers()
    {
        $this->answers = [];
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
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title ?: null;
    }
}