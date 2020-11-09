<?php

namespace JuriBlox\Sdk\Domain\Documents\Entities;

use DateTime;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentCollaborationId;

class DocumentCollaboration
{
    /**
     * @var DocumentCollaborationId
     */
    private $id;
    
    /**
     * @var string
     */
    private $state;
    
    /**
     * @var bool
     */
    private $realtime;
    
    /**
     * @var bool
     */
    private $sendEmails;
    
    /**
     * @var DateTime
     */
    private $deadline;
    
    /**
     * @var string
     */
    private $personalMessage;
    
    /**
     * @var DateTime
     */
    private $startedAt;
    
    /**
     * @var DocumentCollaborator[]
     */
    private $collaborators;
    
    public static function fromDocumentCollaborationId(DocumentCollaborationId $id)
    {
        $collaboration = new self();
        $collaboration->setId($id);
        
        return $collaboration;
    }
    
    /**
     * @return DocumentCollaborationId
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @param DocumentCollaborationId $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }
    
    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }
    
    /**
     * @return bool
     */
    public function isRealtime()
    {
        return $this->realtime;
    }
    
    /**
     * @param bool $realtime
     */
    public function setRealtime($realtime)
    {
        $this->realtime = $realtime;
    }
    
    /**
     * @return bool
     */
    public function sendEmails()
    {
        return $this->sendEmails;
    }
    
    /**
     * @param bool $sendEmails
     */
    public function setSendEmails($sendEmails)
    {
        $this->sendEmails = $sendEmails;
    }
    
    /**
     * @return DateTime
     */
    public function getDeadline()
    {
        return $this->deadline;
    }
    
    /**
     * @param DateTime $deadline
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;
    }
    
    /**
     * @return string
     */
    public function getPersonalMessage()
    {
        return $this->personalMessage;
    }
    
    /**
     * @param string $personalMessage
     */
    public function setPersonalMessage($personalMessage)
    {
        $this->personalMessage = $personalMessage;
    }
    
    /**
     * @return DateTime
     */
    public function getStartedAt()
    {
        return $this->startedAt;
    }
    
    /**
     * @param DateTime $startedAt
     */
    public function setStartedAt($startedAt)
    {
        $this->startedAt = $startedAt;
    }
    
    /**
     * @return DocumentCollaborator[]
     */
    public function getCollaborators()
    {
        return $this->collaborators;
    }
    
    /**
     * @param DocumentCollaborator $collaborator
     */
    public function addCollaborator($collaborator)
    {
        $this->collaborators[] = $collaborator;
    }
    
}