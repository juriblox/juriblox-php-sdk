<?php

namespace JuriBlox\Sdk\Infrastructure\Transformers\Documents;

use DateTime;
use JuriBlox\Sdk\Domain\Documents\Entities\DocumentCollaboration;
use JuriBlox\Sdk\Domain\Documents\Entities\DocumentCollaborator;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentCollaborationId;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentCollaboratorId;

class DocumentCollaborationTransformer
{
    /**
     * Create a DocumentCollaboration from a DTO returned by the JuriBlox API.
     *
     * @param object $dto
     *
     * @return DocumentCollaboration
     */
    public static function read($dto)
    {
        $collaboration = DocumentCollaboration::fromDocumentCollaborationId(new DocumentCollaborationId($dto->id));
        $collaboration->setState($dto->state);
        $collaboration->setRealtime($dto->realtime);
        $collaboration->setSendEmails($dto->send_emails);
        $collaboration->setDeadline(new DateTime($dto->deadline));
        $collaboration->setPersonalMessage($dto->personal_message);
        $collaboration->setStartedAt(new DateTime($dto->started_at));
        
        foreach ($dto->collaborators as $dtoCollaborator) {
            $collaborator = DocumentCollaborator::fromDocumentCollaboratorId(new DocumentCollaboratorId($dtoCollaborator->id));
            $collaborator->setName($dtoCollaborator->name);
            $collaborator->setEmail($dtoCollaborator->email);
            $collaborator->setType($dtoCollaborator->type);
            $collaborator->setState($dtoCollaborator->state);
            $collaborator->setEdit($dtoCollaborator->edit);
            $collaborator->setSuggest($dtoCollaborator->suggest);
            $collaborator->setComment($dtoCollaborator->comment);
            $collaborator->setUrl($dtoCollaborator->url);
            
            $collaboration->addCollaborator($collaborator);
        }
        
        return $collaboration;
    }
    
    /**
     * Generate a DTO from an existing DocumentCollaboration object.
     *
     * @param DocumentCollaboration $collaboration
     *
     * @return array
     */
    public static function write(DocumentCollaboration $collaboration)
    {
        $data = [
            'realtime'         => $collaboration->isRealtime(),
            'deadline'         => $collaboration->getDeadline()->format('c'),
            'personal_message' => $collaboration->getPersonalMessage(),
            'send_emails'      => $collaboration->sendEmails(),
        ];
    
        $collaborators = [];
    
        foreach ($collaboration->getCollaborators() as $collaborator) {
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
        
        return $data;
    }
}