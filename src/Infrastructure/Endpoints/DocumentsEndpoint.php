<?php

namespace JuriBlox\Sdk\Infrastructure\Endpoints;

use JuriBlox\Sdk\Domain\Documents\Entities\Document;
use JuriBlox\Sdk\Domain\Documents\Factories\DocumentFactory;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentId;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentReference;
use JuriBlox\Sdk\Domain\Documents\Values\TemplateId;
use JuriBlox\Sdk\Infrastructure\Collections\DocumentsCollection;

class DocumentsEndpoint extends AbstractEndpoint implements EndpointInterface
{
    /**
     * Get all documents with a specific reference
     *
     * @param DocumentReference $reference
     *
     * @return DocumentsCollection|Document[]
     */
    public function findByReference(DocumentReference $reference)
    {
        return DocumentsCollection::fromEndpoint($this)->filterByReference($reference);
    }

    /**
     * Get all documents based on a specific template ID
     *
     * @param TemplateId $templateId
     *
     * @return DocumentsCollection|Document[]
     */
    public function findWithTemplateId(TemplateId $templateId)
    {
        return DocumentsCollection::fromEndpoint($this)->filterByTemplateId($templateId);
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

        return DocumentFactory::createFromDto($result);
    }
}