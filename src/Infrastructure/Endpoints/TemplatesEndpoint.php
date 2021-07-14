<?php

namespace JuriBlox\Sdk\Infrastructure\Endpoints;

use JuriBlox\Sdk\Domain\Documents\Entities\Preview;
use JuriBlox\Sdk\Domain\Documents\Entities\Template;
use JuriBlox\Sdk\Domain\Documents\Values\TemplateId;
use JuriBlox\Sdk\Domain\Documents\Entities\PreviewRequest;
use JuriBlox\Sdk\Infrastructure\Collections\TemplatesCollection;
use JuriBlox\Sdk\Infrastructure\Endpoints\Templates\QuestionnaireEndpoint;
use JuriBlox\Sdk\Infrastructure\Transformers\Documents\PreviewTransformer;
use JuriBlox\Sdk\Infrastructure\Transformers\Documents\TemplateTransformer;

class TemplatesEndpoint extends AbstractEndpoint implements EndpointInterface
{
    /**
     * Get all templates.
     *
     * @return TemplatesCollection|Template[]
     */
    public function findAll()
    {
        return TemplatesCollection::fromEndpoint($this);
    }

    /**
     * Get a template by its ID.
     *
     * @param TemplateId $id
     *
     * @return Template
     */
    public function findOneById(TemplateId $id)
    {
        $result = $this->driver->get('templates/{id}', [
            'id' => $id->getInteger(),
        ]);

        return TemplateTransformer::read($result);
    }

    /**
     * Get an endpoint for working with a template's questionnaire.
     *
     * @param TemplateId $id
     *
     * @return QuestionnaireEndpoint
     */
    public function questionnaire(TemplateId $id)
    {
        return QuestionnaireEndpoint::fromParentEndpoint($this, $id);
    }
    
    /**
     * @param PreviewRequest $request
     *
     * @return Preview
     */
    public function preview(PreviewRequest $request)
    {
        $result = $this->driver->post('templates/{id}/preview', [
            'id'  => $request->getId()->getInteger(),
            'css' => $request->isCss() ? 'true' : 'false'
        ], ['answers' => $request->getAnswers()]);
        
        return PreviewTransformer::read($result->data);
    }
}
