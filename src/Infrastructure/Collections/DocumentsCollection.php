<?php

namespace JuriBlox\Sdk\Infrastructure\Collections;

use JuriBlox\Sdk\Domain\Documents\Entities\Template;
use JuriBlox\Sdk\Domain\Documents\Factories\DocumentFactory;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentReference;
use JuriBlox\Sdk\Domain\Documents\Values\TemplateId;
use JuriBlox\Sdk\Infrastructure\Endpoints\EndpointInterface;

class DocumentsCollection extends AbstractPagedCollection
{
    /**
     * @param EndpointInterface $endpoint
     *
     * @return DocumentsCollection
     */
    public static function fromEndpoint($endpoint)
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