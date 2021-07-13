<?php

namespace JuriBlox\Sdk\Domain\Documents\Entities;

use JuriBlox\Sdk\Domain\Documents\Values\DocumentCollaboratorId;

class DocumentCollaborator
{
    /**
     * @var DocumentCollaboratorId
     */
    private $id;
    
    /**
     * @var string
     */
    private $name;
    
    /**
     * @var string
     */
    private $email;
    
    /**
     * @var string
     */
    private $type;
    
    /**
     * @var string
     */
    private $state;
    
    /**
     * @var bool
     */
    private $edit;
    
    /**
     * @var bool
     */
    private $suggest;
    
    /**
     * @var bool
     */
    private $comment;
    
    /**
     * @var string
     */
    private $url;
    
    public static function fromDocumentCollaboratorId(DocumentCollaboratorId $id)
    {
        $collaboration = new self();
        $collaboration->setId($id);
        
        return $collaboration;
    }
    
    /**
     * @return DocumentCollaboratorId
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @param DocumentCollaboratorId $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
    
    /**
     * @return bool
     */
    public function canEdit()
    {
        return $this->edit;
    }
    
    /**
     * @param bool $edit
     */
    public function setEdit($edit)
    {
        $this->edit = $edit;
    }
    
    /**
     * @return bool
     */
    public function canSuggest()
    {
        return $this->suggest;
    }
    
    /**
     * @param bool $suggest
     */
    public function setSuggest($suggest)
    {
        $this->suggest = $suggest;
    }
    
    /**
     * @return bool
     */
    public function canComment()
    {
        return $this->comment;
    }
    
    /**
     * @param bool $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }
    
    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
    
    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
}