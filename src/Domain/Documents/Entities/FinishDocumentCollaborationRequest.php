<?php

namespace JuriBlox\Sdk\Domain\Documents\Entities;

use JuriBlox\Sdk\Domain\Documents\Values\DocumentCollaborationId;

class FinishDocumentCollaborationRequest
{
    /**
     * @var DocumentCollaborationId
     */
    private $id;
    
    /**
     * @var bool
     */
    private $force;
    
    /**
     * @var string|null
     */
    private $message;
    
    /**
     * @var array
     */
    private $sendFinalDocumentTo;
    
    public static function fromDocumentCollaborationId(DocumentCollaborationId $id)
    {
        $request = new self();
        $request->setId($id);
        
        return $request;
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
     * @return bool
     */
    public function isForce()
    {
        return $this->force;
    }
    
    /**
     * @param bool $force
     */
    public function setForce($force)
    {
        $this->force = $force;
    }
    
    /**
     * @return string|null
     */
    public function getMessage()
    {
        return $this->message;
    }
    
    /**
     * @param string|null $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
    
    /**
     * @return array
     */
    public function getSendFinalDocumentTo()
    {
        return $this->sendFinalDocumentTo;
    }
    
    /**
     * @param string $sendFinalDocumentTo
     */
    public function addSendFinalDocumentTo($sendFinalDocumentTo)
    {
        $this->sendFinalDocumentTo[] = $sendFinalDocumentTo;
    }
}