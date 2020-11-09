<?php

namespace JuriBlox\Sdk\Domain\Documents\Entities;

use DateTime;

class StartDocumentCollaborationRequest
{
    /**
     * @var bool
     */
    private $realtime;
    
    /**
     * @var DateTime|null
     */
    private $deadline;
    
    /**
     * @var DocumentCollaborator[]
     */
    private $collaborators;
    
    /**
     * @var string|null
     */
    private $personalMessage;
    
    /**
     * @var bool
     */
    private $sendEmails;
    
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
     * @return DateTime|null
     */
    public function getDeadline()
    {
        return $this->deadline;
    }
    
    /**
     * @param DateTime|null $deadline
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;
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
    
    /**
     * @return string|null
     */
    public function getPersonalMessage()
    {
        return $this->personalMessage;
    }
    
    /**
     * @param string|null $personalMessage
     */
    public function setPersonalMessage($personalMessage)
    {
        $this->personalMessage = $personalMessage;
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
    
}