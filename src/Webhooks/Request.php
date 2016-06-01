<?php

namespace JuriBlox\Sdk\Webhooks;

use JuriBlox\Sdk\Webhooks\Requests\DocumentGenerationRequest;
use JuriBlox\Sdk\Webhooks\Requests\TemplatePublishRequest;

class Request
{
    /**
     * @var RequestEvent
     */
    private $event;

    /**
     * @var object
     */
    private $payload;

    /**
     * Request constructor
     */
    private  function __construct()
    {

    }

    /**
     * Generate a WebhookRequest based on what we got from php://input
     *
     * @return Request|DocumentGenerationRequest|TemplatePublishRequest
     */
    public static function fromInput()
    {
        return static::fromJson(file_get_contents('php://input'));
    }

    /**
     * Generate a WebhookRequest based on a JSON string
     *
     * @param $json
     *
     * @return Request|DocumentGenerationRequest|TemplatePublishRequest
     */
    public static function fromJson($json)
    {
        $payload = json_decode($json);
        if ($payload === null)
        {
            throw new \InvalidArgumentException();
        }

        $request = new static();
        $request->event = new RequestEvent($payload->event);
        $request->payload = $payload;

        switch ($request->event->getString())
        {
            case DocumentGenerationRequest::EVENT_SUCCEEDED:
            case DocumentGenerationRequest::EVENT_FAILED:
                return DocumentGenerationRequest::fromRequest($request);

            default:
                return $request;
        }
    }

    /**
     * @return RequestEvent
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @return object
     */
    public function getPayload()
    {
        return $this->payload;
    }
}