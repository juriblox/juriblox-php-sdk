<?php

namespace JuriBlox\Sdk\Infrastructure\Endpoints;

use JuriBlox\Sdk\Domain\Customers\Values\CustomerReference;
use JuriBlox\Sdk\Domain\Documents\Entities\Document;
use JuriBlox\Sdk\Domain\Documents\Entities\DocumentRequest;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentId;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentReference;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentRequestId;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentRequestStatus;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentStatus;
use JuriBlox\Sdk\Domain\Documents\Values\TemplateId;
use JuriBlox\Sdk\Exceptions\CannotParseResponseException;
use JuriBlox\Sdk\Exceptions\DocumentRequestException;
use JuriBlox\Sdk\Infrastructure\Collections\DocumentsCollection;
use JuriBlox\Sdk\Infrastructure\Transformers\Documents\DocumentTransformer;
use JuriBlox\Sdk\Utils\DateTimeConvertor;

class DocumentsEndpoint extends AbstractEndpoint implements EndpointInterface
{
    /**
     * Get all documents generated for a specific customer.
     *
     * @param CustomerReference $reference
     *
     * @return DocumentsCollection|Document[]
     */
    public function findByCustomer(CustomerReference $reference)
    {
        return DocumentsCollection::fromEndpointWithSettings($this, 'customers/{reference}/documents', 'documents', [
            'reference' => $reference->getString(),
        ]);
    }

    /**
     * Get all documents with a specific reference.
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
     * Get a document by its ID.
     *
     * @param DocumentId $id
     *
     * @return Document
     */
    public function findOneById(DocumentId $id)
    {
        $result = $this->driver->get('documents/{id}', [
            'id' => $id->getInteger(),
        ]);

        return DocumentTransformer::read($result);
    }

    /**
     * Get all documents based on a specific template ID.
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
     * Request a document to be generated.
     *
     * @param DocumentRequest $request
     *
     * @return DocumentRequest
     *
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
            'answers'    => [],
            'variables'  => [],
        ];

        if (null !== $request->getTemplateVersion()) {
            $data['template_version'] = $request->getTemplateVersion();
        }

        // Add the answers
        foreach ($request->getAnswers() as $answer) {
            $value = $answer->getValue();

            // DateTime casten
            if ($value instanceof \DateTime) {
                $value = DateTimeConvertor::toVendorFormat($value);
            }

            // Array met uh, dingen
            elseif (is_array($value)) {
                for ($i = 0, $_i = sizeof($value); $i < $_i; ++$i) {
                    $value[$i] = (string) $value[$i];
                }
            }

            $data['answers'][$answer->getQuestion()->getId()->getInteger()] = $value;
        }

        // Add the variables
        foreach ($request->getVariables() as $name => $value) {
            $data['variables'][$name] = $value;
        }

        /*
         * Request the document
         */
        $result = $this->driver->post('templates/{templateId}/generate', [
            'templateId' => $request->getTemplateId(),
        ], $data);

        // Check result code
        if ($result->status == DocumentStatus::STATUS_FAILED) {
            throw new DocumentRequestException($result->message);
        }

        // Amend DocumentRequest information
        $request->setId(new DocumentRequestId($result->requestId));
        $request->setStatus(DocumentStatus::fromCode($result->status));

        return $request;
    }

    /**
     * Get the current status for a requested document.
     *
     * @param DocumentRequestId $id
     *
     * @return DocumentRequestStatus
     *
     * @throws CannotParseResponseException
     */
    public function getRequestStatus(DocumentRequestId $id)
    {
        $result = $this->driver->get('documents/{id}/status', [
            'id' => $id->getInteger(),
        ]);

        $status = new DocumentRequestStatus($id, DocumentStatus::fromCode($result->status));
        if ($status->getStatus()->getCode() == DocumentStatus::STATUS_GENERATED) {
            if (!isset($result->documentId)) {
                throw new CannotParseResponseException();
            }

            $status->setDocumentId(new DocumentId($result->documentId));
        }

        return $status;
    }
}
