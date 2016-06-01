<?php


namespace JuriBlox\Sdk\Webhooks\Requests;

use JuriBlox\Sdk\Domain\Documents\Values\DocumentId;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentReference;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentRequestId;
use JuriBlox\Sdk\Validation\Assertion;
use JuriBlox\Sdk\Webhooks\Request;

class DocumentGenerationRequest extends Request
{
    /**
     * Document generation has failed
     */
    const EVENT_FAILED = 'document.generation.failed';

    /**
     * Document generation has succeeded
     */
    const EVENT_SUCCEEDED = 'document.generation.succeeded';

    /**
     * @var DocumentId
     */
    private $documentId;

    /**
     * @var DocumentReference
     */
    private $documentReference;

    /**
     * @var DocumentRequestId
     */
    private $requestId;

    /**
     * @var bool
     */
    private $success;

    /**
     * DocumentGenerationRequest constructor
     */
    private function __construct()
    {

    }

    /**
     * @param Request $request
     *
     * @return DocumentGenerationRequest
     */
    public static function fromRequest(Request $request)
    {
        Assertion::inArray($request->getEvent()->getString(), [self::EVENT_SUCCEEDED, self::EVENT_FAILED]);

        $castedRequest = new static();
        $castedRequest->success = ($request->getEvent()->getString() == self::EVENT_SUCCEEDED);

        $payload = $request->getPayload();

        if (isset($payload->requestId))
        {
            $castedRequest->requestId = DocumentRequestId::fromOptional($payload->requestId);
        }

        if (isset($payload->document))
        {
            $castedRequest->documentId = DocumentId::fromOptional($payload->document->id);
            $castedRequest->documentReference = DocumentId::fromOptional($payload->document->reference);
        }

        return $castedRequest;
    }

    /**
     * @return DocumentId
     */
    public function getDocumentId()
    {
        return $this->documentId;
    }

    /**
     * @return DocumentReference
     */
    public function getDocumentReference()
    {
        return $this->documentReference;
    }

    /**
     * @return DocumentRequestId
     */
    public function getRequestId()
    {
        return $this->requestId;
    }
}