<?php

namespace JuriBlox\Sdk\Infrastructure\Endpoints;

use JuriBlox\Sdk\Domain\Customers\Entities\Customer;
use JuriBlox\Sdk\Domain\Customers\Values\Contact;
use JuriBlox\Sdk\Domain\Documents\Entities\Document;
use JuriBlox\Sdk\Domain\Documents\Entities\Question;
use JuriBlox\Sdk\Domain\Documents\Entities\QuestionAnswer;
use JuriBlox\Sdk\Domain\Documents\Entities\Tag;
use JuriBlox\Sdk\Domain\Documents\Factories\QuestionAnswerFactory;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentId;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentReference;
use JuriBlox\Sdk\Domain\Documents\Values\File;
use JuriBlox\Sdk\Domain\Documents\Values\Language;
use JuriBlox\Sdk\Domain\Documents\Values\TemplateId;
use JuriBlox\Sdk\Domain\Offices\Entities\Office;
use JuriBlox\Sdk\Infrastructure\Collections\DocumentsCollection;

class DocumentsEndpoint extends AbstractEndpoint
{
    /**
     * Get all documents with a specific reference
     *
     * @param DocumentReference $reference
     *
     * @return DocumentsCollection
     */
    public function findByReference(DocumentReference $reference)
    {
        return DocumentsCollection::fromDriver($this->driver)->filterByReference($reference);
    }

    /**
     * Get all documents based on a specific template ID
     *
     * @param TemplateId $templateId
     *
     * @return DocumentsCollection
     */
    public function findByTemplateId(TemplateId $templateId)
    {
        return DocumentsCollection::fromDriver($this->driver)->filterByTemplateId($templateId);
    }

    /**
     * Get a document by its ID
     *
     * @param DocumentId $id
     *
     * @return Document
     */
    public function findOneById(DocumentId $id)
    {
        $result = $this->driver->get('documents/{id}', [
            'id' => $id->getId()
        ]);

        $document = Document::fromIdString($result->id);
        $document->setTitle($result->title);
        $document->setReference(new DocumentReference($result->reference));

        $document->setAlertDate(new \DateTime($result->validTill));
        $document->setCreatedDatetime(new \DateTime($result->createdAt));

        $office = Office::fromIdString($result->office->id);
        $office->setName($result->office->name);

        $document->setOffice($office);

        if ($result->customer !== [])
        {
            $customer = Customer::fromReferenceString($result->customer->reference);
            $customer->setCompany($result->customer->company);

            $contact = new Contact($result->contact->name);
            if ($result->contact->email !== null)
            {
                $contact->setEmail($result->contact->email);
            }

            $customer->setContact($contact);
        }

        $document->setLanguage(new Language($result->language->code, $result->language->name));

        // Files
        foreach ($result->files as $entry)
        {
            $document->addFile(File::fromText($entry->url, $entry->filename, $entry->type));
        }

        // Tags
        foreach ($result->tags as $entry)
        {
            $tag = Tag::fromIdString($entry->id);
            $tag->setName($entry->name);

            $document->addTag($tag);
        }

        // Answers
        foreach ($result->answers as $entry)
        {
            $document->addAnswer(QuestionAnswerFactory::createFromDto($entry));
        }

        return $document;
    }
}