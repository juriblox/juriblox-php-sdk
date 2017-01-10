<?php

namespace JuriBlox\Sdk\Webhooks\Requests;

use JuriBlox\Sdk\Domain\Documents\Values\TemplateId;
use JuriBlox\Sdk\Validation\Assertion;
use JuriBlox\Sdk\Webhooks\Request;

class TemplatePublishRequest extends Request
{
    /**
     * A new template version has been published.
     */
    const EVENT_PUBLISHED = 'template.published';

    /**
     * @var TemplateId
     */
    private $templateId;

    /**
     * @return TemplateId
     */
    public function getTemplateId(): TemplateId
    {
        return $this->templateId;
    }

    /**
     * TemplatePublishRequest constructor.
     */
    private function __construct()
    {
    }

    /**
     * @param Request $request
     *
     * @return TemplatePublishRequest
     */
    public static function fromRequest(Request $request)
    {
        Assertion::inArray($request->getEvent()->getString(), [self::EVENT_PUBLISHED]);

        $castedRequest = new static();

        $payload = $request->getPayload();

        if (isset($payload->template)) {
            $castedRequest->templateId = TemplateId::fromOptional($payload->template->id);
        }

        return $castedRequest;
    }
}
