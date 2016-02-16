<?php

namespace JuriBlox\Sdk\Domain\Documents\Entities;

use JuriBlox\Sdk\Domain\Documents\Values\Definition;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentId;
use JuriBlox\Sdk\Domain\Documents\Values\Language;
use JuriBlox\Sdk\Domain\Documents\Values\Revision;
use JuriBlox\Sdk\Domain\Documents\Values\TemplateId;
use JuriBlox\Sdk\Domain\Documents\Values\TemplateStatus;
use JuriBlox\Sdk\Domain\Offices\Entities\Office;
use JuriBlox\Sdk\Domain\Users\Entities\User;

class Template
{
    /**
     * Creation date and time
     *
     * @var \DateTime
     */
    private $createdDatetime;

    /**
     * User that created the template
     *
     * @var User
     */
    private $creator;

    /**
     * Custom template
     *
     * @var bool
     */
    private $custom;

    /**
     * Definitions
     *
     * @var array
     */
    private $definitions;

    /**
     * Description
     *
     * @var string
     */
    private $description;

    /**
     * Template ID
     *
     * @var TemplateId
     */
    private $id;

    /**
     * Language this template is written in
     *
     * @var Language
     */
    private $language;

    /**
     * Most recent document generated using this template
     *
     * @var DocumentId
     */
    private $lastDocument;

    /**
     * Template name
     *
     * @var string
     */
    private $name;

    /**
     * Office this template belongs to
     *
     * @var Office
     */
    private $office;

    /**
     * Current revision
     *
     * @var Revision
     */
    private $revision;

    /**
     * Current status
     *
     * @var TemplateStatus
     */
    private $status;

    /**
     * Linked tags
     *
     * @var array
     */
    private $tags;

    /**
     * Template variables
     *
     * @var array
     */
    private $variables;

    /**
     * Create a template entity based on an existing identity
     *
     * @param TemplateId $id
     *
     * @return Template
     */
    public static function fromId(TemplateId $id)
    {
        $template = new static();
        $template->id = $id;

        return $template;
    }

    /**
     * Create a template entity based on an identity represented as a string
     *
     * @param string $id
     *
     * @return Template
     */
    public static function fromIdString($id)
    {
        return static::fromId(new TemplateId($id));
    }

    /**
     * Template constructor
     */
    private function __construct()
    {
        $this->custom = false;

        $this->clearTags();
        $this->clearDefinitions();
        $this->clearVariables();
    }

    /**
     * Add a definition
     *
     * @param Definition $definition
     */
    public function addDefinition(Definition $definition)
    {
        $this->definitions[] = $definition;
    }

    /**
     * Add a tag
     *
     * @param Tag $tag
     */
    public function addTag(Tag $tag)
    {
        $this->tags[] = $tag;
    }

    /**
     * Add a variable
     *
     * @param TemplateVariable $variable
     */
    public function addVariable(TemplateVariable $variable)
    {
        $this->variables[] = $variable;
    }

    /**
     * Clear the template's definitions
     */
    public function clearDefinitions()
    {
        $this->definitions = [];
    }

    /**
     * Clear the linked tags
     */
    public function clearTags()
    {
        $this->tags = [];
    }

    /**
     * Clear the template's variables
     */
    public function clearVariables()
    {
        $this->variables = [];
    }

    /**
     * @return \DateTime
     */
    public function getCreatedDatetime()
    {
        return $this->createdDatetime;
    }

    /**
     * @return User
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @return array
     */
    public function getDefinitions()
    {
        return $this->definitions;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return TemplateId
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return DocumentId
     */
    public function getLastDocument()
    {
        return $this->lastDocument;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Office
     */
    public function getOffice()
    {
        return $this->office;
    }

    /**
     * @return Revision
     */
    public function getRevision()
    {
        return $this->revision;
    }

    /**
     * @return TemplateStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return array
     */
    public function getVariables()
    {
        return $this->variables;
    }

    /**
     * @return bool
     */
    public function isCustom()
    {
        return $this->custom;
    }

    /**
     * @param \DateTime $createdDatetime
     */
    public function setCreatedDatetime(\DateTime $createdDatetime)
    {
        $this->createdDatetime = $createdDatetime;
    }

    /**
     * @param User $creator
     */
    public function setCreator(User $creator)
    {
        $this->creator = $creator;
    }

    /**
     * @param bool $custom
     */
    public function setCustom($custom)
    {
        $this->custom = (bool) $custom;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description ?: null;
    }

    /**
     * @param Language $language
     */
    public function setLanguage(Language $language)
    {
        $this->language = $language;
    }

    /**
     * @param DocumentId $lastDocument
     */
    public function setLastDocument(DocumentId $lastDocument)
    {
        $this->lastDocument = $lastDocument;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name ?: null;
    }

    /**
     * @param Office $office
     */
    public function setOffice(Office $office)
    {
        $this->office = $office;
    }

    /**
     * @param Revision $revision
     */
    public function setRevision(Revision $revision)
    {
        $this->revision = $revision;
    }

    /**
     * @param TemplateStatus $status
     */
    public function setStatus(TemplateStatus $status)
    {
        $this->status = $status;
    }
}