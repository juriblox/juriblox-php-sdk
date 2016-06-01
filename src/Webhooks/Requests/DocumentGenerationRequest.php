<?php


namespace JuriBlox\Sdk\Webhooks\Requests;

use JuriBlox\Sdk\Domain\Documents\Values\DocumentId;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentReference;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentRequestId;
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
     * @var bool
     */
    private $success;

    /**
     * @var DocumentRequestId
     */
    private $requestId;

    /**
     * @var DocumentId
     */
    private $documentId;

    /**
     * @var DocumentReference
     */
    private $documentReference;

    /**
     * @param Request $request
     *
     * @return DocumentGenerationRequest
     */
    public static function fromRequest(Request $request)
    {
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
     * DocumentGenerationRequest constructor
     */
    private function __construct()
    {

    }
}