<?php

namespace JuriBlox\Sdk\Domain\Documents\Factories;

use JuriBlox\Sdk\Domain\Documents\Entities\Tag;
use JuriBlox\Sdk\Domain\Documents\Entities\Template;
use JuriBlox\Sdk\Domain\Documents\Entities\TemplateVariable;
use JuriBlox\Sdk\Domain\Documents\Values\Definition;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentId;
use JuriBlox\Sdk\Domain\Documents\Values\Language;
use JuriBlox\Sdk\Domain\Documents\Values\Revision;
use JuriBlox\Sdk\Domain\Documents\Values\TemplateId;
use JuriBlox\Sdk\Domain\Documents\Values\TemplateStatus;
use JuriBlox\Sdk\Domain\Offices\Entities\Office;
use JuriBlox\Sdk\Domain\Users\Entities\User;

class TemplateFactory
{
    /**
     * Create a Template from a DTO returned by the JuriBlox API
     *
     * @param $dto
     *
     * @return Template
     */
    public static function createFromDto($dto)
    {
        $template = Template::fromIdString($dto->id);
        $template->setName($dto->name);
        $template->setDescription($dto->description);

        if ($dto->lastDocument !== null)
        {
            $template->setLastDocument(new DocumentId($dto->lastDocument));
        }

        $template->setCreatedDatetime(new \DateTime($dto->createdAt));

        $user = User::fromIdString($dto->creator->id);
        $user->setName($dto->creator->name);

        $office = Office::fromIdString($dto->office->id);
        $office->setName($dto->office->name);

        $template->setCreator($user);
        $template->setOffice($office);

        $template->setLanguage(new Language($dto->language->code, $dto->language->name));
        $template->setStatus(new TemplateStatus($dto->status->code, $dto->status->name));
        $template->setRevision(new Revision(new TemplateId($dto->revision->derivedOf), $dto->revision->version));

        foreach ($dto->variables as $entry)
        {
            $variable = TemplateVariable::fromIdString($entry->id);
            $variable->setName($entry->name);
            $variable->setTitle($entry->title);
            $variable->setDescription($entry->description);
            $variable->setValue($entry->value);

            $template->addVariable($variable);
        }

        foreach ($dto->definitions as $entry)
        {
            $template->addDefinition(new Definition($entry->name, $entry->description, $entry->visible));
        }

        foreach ($dto->tags as $entry)
        {
            $tag = Tag::fromIdString($entry->id);
            $tag->setName($entry->name);

            $template->addTag($tag);
        }

        return $template;
    }
}