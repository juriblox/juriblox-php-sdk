<?php

namespace JuriBlox\Sdk\Infrastructure\Endpoints\Templates;

use JuriBlox\Sdk\Domain\Documents\Values\Questionnaire;
use JuriBlox\Sdk\Domain\Documents\Values\TemplateId;
use JuriBlox\Sdk\Infrastructure\Endpoints\AbstractEndpoint;
use JuriBlox\Sdk\Infrastructure\Endpoints\EndpointInterface;
use JuriBlox\Sdk\Infrastructure\Endpoints\TemplatesEndpoint;
use JuriBlox\Sdk\Infrastructure\Transformers\Documents\QuestionnaireTransformer;

class QuestionnaireEndpoint extends AbstractEndpoint implements EndpointInterface
{
    /**
     * @var TemplateId
     */
    private $templateId;

    /**
     * Create an endpoint based on a parent endpoint.
     *
     * @param TemplatesEndpoint $parent
     * @param TemplateId        $id
     *
     * @return QuestionnaireEndpoint
     */
    public static function fromParentEndpoint(TemplatesEndpoint $parent, TemplateId $id)
    {
        /** @var QuestionnaireEndpoint $endpoint */
        $endpoint = static::fromEndpoint($parent);
        $endpoint->templateId = $id;

        return $endpoint;
    }

    /**
     * Get the questionnaire belonging to the template.
     *
     * @return Questionnaire
     */
    public function get()
    {
        $result = $this->driver->get('templates/{templateId}/questions', [
            'templateId' => $this->templateId,
        ]);

        return QuestionnaireTransformer::read($result);
    }
}
