<?php

namespace JuriBlox\Sdk\Infrastructure\Endpoints;

use JuriBlox\Sdk\Domain\Documents\Entities\Document;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentId;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentReference;
use JuriBlox\Sdk\Domain\Documents\Values\TemplateId;
use JuriBlox\Sdk\Infrastructure\Collections\DocumentsCollection;

class DocumentsEndpoint extends AbstractEndpoint
{
    /**
     * Get all documents with a specific reference
     *
     * @param DocumentReference $reference
     *
     * @return DocumentsCollection
     */
    public function findByReference(DocumentReference $reference)
    {
        return DocumentsCollection::fromDriver($this->driver)->filterByReference($reference);
    }

    /**
     * Get all documents based on a specific template ID
     *
     * @param TemplateId $templateId
     *
     * @return DocumentsCollection
     */
    public function findByTemplateId(TemplateId $templateId)
    {
        return DocumentsCollection::fromDriver($this->driver)->filterByTemplateId($templateId);
    }

    /**
     * Get a document by its ID
     *
     * @param DocumentId $id
     *
     * @return Document
     */
    public function findOneById(DocumentId $id)
    {
        $result = $this->driver->get('documents/{id}', [
            'id' => $id->getId()
        ]);

        $document = Document::fromIdString($result->id);

        return $document;
    }
}