<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

class DocumentRequestStatus
{
    /**
     * Document ID
     *
     * @var DocumentId
     */
    private $documentId;

    /**
     * ID
     *
     * @var DocumentRequestId
     */
    private $id;

    /**
     * Status
     *
     * @var DocumentStatus
     */
    private $status;

    /**
     * DocumentRequestStatus constructor
     *
     * @param DocumentRequestId     $id
     * @param DocumentStatus $status
     */
    public function __construct(DocumentRequestId $id, DocumentStatus $status)
    {
        $this->id = $id;
        $this->status = $status;
    }

    /**
     * @return DocumentId
     */
    public function getDocumentId()
    {
        return $this->documentId;
    }

    /**
     * @return DocumentRequestId
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return DocumentStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param DocumentId $documentId
     */
    public function setDocumentId(DocumentId $documentId)
    {
        $this->documentId = $documentId;
    }
}