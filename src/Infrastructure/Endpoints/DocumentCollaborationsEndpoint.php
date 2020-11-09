<?php

namespace JuriBlox\Sdk\Infrastructure\Endpoints;

use JuriBlox\Sdk\Domain\Documents\Entities\DocumentCollaboration;
use JuriBlox\Sdk\Domain\Documents\Entities\DocumentCollaborator;
use JuriBlox\Sdk\Domain\Documents\Entities\FinishDocumentCollaborationRequest;
use JuriBlox\Sdk\Domain\Documents\Entities\StartDocumentCollaborationRequest;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentCollaborationId;
use JuriBlox\Sdk\Infrastructure\Collections\DocumentCollaborationsCollection;
use JuriBlox\Sdk\Infrastructure\Transformers\Documents\DocumentCollaborationTransformer;

class DocumentCollaborationsEndpoint extends AbstractEndpoint implements EndpointInterface
{
    public function findOneById(DocumentCollaborationId $id)
    {
        $result = $this->driver->get('collaborations/{collaboration}', [
            'collaboration' => $id->getString(),
        ]);
    
        return DocumentCollaborationTransformer::read($result);
    }
    
    public function findAll()
    {
        return DocumentCollaborationsCollection::fromEndpointWithSettings($this, 'collaborations', 'collaborations');
    }
    
    public function store(StartDocumentCollaborationRequest $request)
    {
        $data = [
            'realtime'         => $request->isRealtime(),
            'deadline'         => $request->getDeadline()->format('c'),
            'personal_message' => $request->getPersonalMessage(),
            'send_emails'      => $request->sendEmails(),
        ];
        
        $collaborators = [];
        
        foreach ($request->getCollaborators() as $collaborator) {
            $collaborators[] = [
                'type'    => $collaborator->getType(),
                'email'   => $collaborator->getEmail(),
                'name'    => $collaborator->getName(),
                'edit'    => $collaborator->canEdit(),
                'suggest' => $collaborator->canSuggest(),
                'comment' => $collaborator->canComment(),
            ];
        }
        
        $data['collaborators'] = $collaborators;
        
        $this->driver->post('v2/documents/collaborations', null, $data);
    }
    
    public function update(DocumentCollaboration $collaboration)
    {
        $this->driver->patch('v2/collaborations/{collaboration}', [
            'collaboration' => $collaboration->getId()->getString(),
        ], DocumentCollaborationTransformer::write($collaboration));
    }
    
    public function finish(FinishDocumentCollaborationRequest $request)
    {
        $this->driver->patch('v2/collaborations/{collaboration}/finish', [
            'collaboration' => $request->getId()->getString(),
        ], [
            'force'               => $request->isForce(),
            'message'             => $request->getMessage(),
            'send_final_document' => $request->getSendFinalDocumentTo(),
        ]);
    }
    
    public function abort(DocumentCollaboration $collaboration)
    {
        $this->driver->patch('v2/collaborations/{collaboration}/abort', [
            'collaboration' => $collaboration->getId()->getString(),
        ], []);
    }
    
    public function removeCollaborator(DocumentCollaboration $collaboration, DocumentCollaborator $collaborator)
    {
        $this->driver->delete('v2/collaborations/{collaboration}/collaborator/{collaborator}', [
            'collaboration' => $collaboration->getId()->getString(),
            'collaborator'  => $collaborator->getId()->getString(),
        ], []);
    }
}