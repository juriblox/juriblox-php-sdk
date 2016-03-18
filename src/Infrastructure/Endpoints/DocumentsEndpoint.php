<?php

namespace JuriBlox\Sdk\Infrastructure\Endpoints;

use JuriBlox\Sdk\Domain\Documents\Entities\Document;
use JuriBlox\Sdk\Domain\Documents\Entities\DocumentRequest;
use JuriBlox\Sdk\Domain\Documents\Factories\DocumentFactory;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentId;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentReference;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentRequestStatus;
use JuriBlox\Sdk\Domain\Documents\Values\TemplateId;
use JuriBlox\Sdk\Exceptions\DocumentRequestException;
use JuriBlox\Sdk\Infrastructure\Collections\DocumentsCollection;
use JuriBlox\Sdk\Utils\DateTimeConvertor;

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
            'id' => $id->getInteger()
        ]);

        return DocumentFactory::createFromDto($result);
    }

    /**
     * Request a document to be generated
     *
     * @param DocumentRequest $request
     *
     * @return Document
     * @throws DocumentRequestException
     */
    public function generate(DocumentRequest $request)
    {
        $data = [
            'title'      => $request->getTitle(),
            'reference'  => $request->getReference()->getString(),
            'customer'   => $request->getCustomer()->getString(),
            'remarks'    => $request->getRemarks(),
            'valid_till' => $request->getAlertDate() ? DateTimeConvertor::toVendorFormat($request->getAlertDate()) : null,
            'answers'    => []
        ];

        // Add the answers
        foreach ($request->getAnswers() as $answer)
        {
            $data['answers'][$answer->getQuestion()->getId()->getInteger()] = $answer->getValue();
        }

        /*
         * Request the document
         */
        $result = $this->driver->post('templates/{templateId}/generate', [
            'templateId' => $request->getTemplateId()
        ], $data);

        // Check result code
        if ($result->status != DocumentRequestStatus::STATUS_REQUESTED)
        {
            throw new DocumentRequestException($result->message);
        }

        return DocumentFactory::createFromRequest(new DocumentId(/* TODO: $result->id */0), $request);
    }
}