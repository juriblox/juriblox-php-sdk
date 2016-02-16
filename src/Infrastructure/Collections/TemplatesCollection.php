<?php

namespace JuriBlox\Sdk\Infrastructure\Collections;

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
use JuriBlox\Sdk\Domain\Offices\Values\OfficeId;
use JuriBlox\Sdk\Domain\Users\Entities\User;
use JuriBlox\Sdk\Infrastructure\Drivers\DriverInterface;

class TemplatesCollection extends AbstractPagedCollection
{
    /**
     * @param DriverInterface $driver
     *
     * @return TemplatesCollection
     */
    public static function fromDriver(DriverInterface $driver)
    {
        return static::fromDriverWithSettings($driver, 'templates', 'templates');
    }

    /**
     * @param $dto
     *
     * @return Template
     */
    public function createEntityFromData($dto)
    {
        $template = Template::fromIdString($dto->id);
        $template->setName($dto->name);
        $template->setDescription($dto->description);

        if ($dto->lastDocument !== null)
        {
            $template->setLastDocument(new DocumentId($dto->lastDocument));
        }

        $template->setCreatedDatetime(new \DateTime($dto->createdAt));
        $template->setCreator(User::fromText($dto->creator->id, $dto->creator->name));

        $template->setOffice(new Office(new OfficeId($dto->office->id), $dto->office->name));
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