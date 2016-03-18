<?php

namespace JuriBlox\Sdk\Infrastructure\Collections;

use JuriBlox\Sdk\Domain\Documents\Entities\Template;
use JuriBlox\Sdk\Domain\Documents\Factories\DocumentFactory;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentReference;
use JuriBlox\Sdk\Domain\Documents\Values\TemplateId;
use JuriBlox\Sdk\Infrastructure\Endpoints\DocumentsEndpoint;

class DocumentsCollection extends AbstractPagedCollection
{
    /**
     * @param DocumentsEndpoint $endpoint
     *
     * @return DocumentsCollection
     */
    public static function fromEndpoint(DocumentsEndpoint $endpoint)
    {
        $collection = new static();
        $collection->endpoint = $endpoint;

        return $collection;
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

        $this->setParameter('reference', $reference->getString());

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
            'template' => $templateId->getInteger()
        ]);

        return $this;
    }

    /**
     * @param $dto
     *
     * @return Document
     */
    protected function createEntityFromData($dto)
    {
        return DocumentFactory::createFromDto($dto);
    }
}