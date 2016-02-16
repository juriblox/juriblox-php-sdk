<?php

namespace JuriBlox\Sdk\Infrastructure\Collections;

use JuriBlox\Sdk\Domain\Documents\Entities\Template;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentReference;
use JuriBlox\Sdk\Domain\Documents\Values\TemplateId;
use JuriBlox\Sdk\Infrastructure\Drivers\DriverInterface;

class DocumentsCollection extends AbstractPagedCollection
{
    /**
     * @param DriverInterface $driver
     *
     * @return DocumentsCollection
     */
    public static function fromDriver(DriverInterface $driver)
    {
        $collection = new static();
        $collection->driver = $driver;

        return $collection;
    }

    /**
     * @param $dto
     *
     * @return Template
     */
    public function createEntityFromData($dto)
    {
        print_r($dto); exit();
    }

    /**
     * Return documents with a specific reference
     *
     * @param DocumentReference $reference
     *
     * @return DocumentsCollection
     */
    public function filterByReference(DocumentReference $reference)
    {
        $this->setKey('documents');
        $this->setUri('documents');

        $this->setUriParameter('reference', $reference->getReference());

        return $this;
    }

    /**
     * Return only documents based on a specific template
     *
     * @param TemplateId $templateId
     *
     * @return DocumentsCollection
     */
    public function filterByTemplateId(TemplateId $templateId)
    {
        $this->setKey('documents');
        $this->setUri('templates/{template}/documents', [
            'template' => $templateId->getId()
        ]);

        return $this;
    }
}