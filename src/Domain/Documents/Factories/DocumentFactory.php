<?php

namespace JuriBlox\Sdk\Domain\Documents\Factories;

use JuriBlox\Sdk\Domain\Customers\Entities\Customer;
use JuriBlox\Sdk\Domain\Customers\Values\Contact;
use JuriBlox\Sdk\Domain\Documents\Entities\Document;
use JuriBlox\Sdk\Domain\Documents\Entities\DocumentRequest;
use JuriBlox\Sdk\Domain\Documents\Entities\Tag;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentId;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentReference;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentStatus;
use JuriBlox\Sdk\Domain\Documents\Values\File;
use JuriBlox\Sdk\Domain\Documents\Values\Language;
use JuriBlox\Sdk\Domain\Offices\Entities\Office;
use JuriBlox\Sdk\Validation\Assertion;

class DocumentFactory
{
    /**
     * Create a Document from a DTO returned by the JuriBlox API
     *
     * @param $dto
     *
     * @return Document
     */
    public static function createFromDto($dto)
    {
        Assertion::nullOrDateTimeString($dto->validTill);
        Assertion::nullOrDateTimeString($dto->createdAt);

        $document = Document::fromIdString($dto->id);
        $document->setTitle($dto->title);
        $document->setReference(new DocumentReference($dto->reference));

        $document->setAlertDate(new \DateTime($dto->validTill));
        $document->setCreatedDatetime(new \DateTime($dto->createdAt));

        $office = Office::fromIdString($dto->office->id);
        $office->setName($dto->office->name);

        $document->setOffice($office);

        if ($dto->customer !== [])
        {
            $customer = Customer::fromReferenceString($dto->customer->reference);
            $customer->setCompany($dto->customer->company);

            if (isset($dto->customer->contact))
            {
                $contact = new Contact($dto->customer->contact->name);
                if ($dto->customer->contact->email !== null)
                {
                    $contact->setEmail($dto->customer->contact->email);
                }

                $customer->setContact($contact);
            }

            $document->setCustomer($customer);
        }

        $document->setLanguage(new Language($dto->language->code, $dto->language->name));

        // Files
        foreach ($dto->files as $entry)
        {
            $document->addFile(File::fromText($entry->url, $entry->filename, $entry->type));
        }

        // Tags
        foreach ($dto->tags as $entry)
        {
            $tag = Tag::fromIdString($entry->id);
            $tag->setName($entry->name);

            $document->addTag($tag);
        }

        // Answers
        if (isset($dto->answers))
        {
            foreach ($dto->answers as $entry)
            {
                $document->addAnswer(QuestionAnswerFactory::createFromDto($entry));
            }
        }

        return $document;
    }

    /**
     * Create a Document based on a DocumentRequest and the DocumentId returned by the JuriBlox API
     *
     * @param DocumentId      $id
     * @param DocumentRequest $request
     *
     * @return Document
     */
    public static function createFromRequest(DocumentId $id, DocumentRequest $request)
    {
        $document = Document::fromId($id);
        $document->setStatus(DocumentStatus::fromCode(DocumentStatus::STATUS_PENDING));

        $document->setTitle($request->getTitle());
        $document->setReference($request->getReference());
        $document->setCustomer(Customer::fromReference($request->getCustomer()));

        $document->setCreatedDatetime(new \DateTime());
        $document->setAlertDate($request->getAlertDate());

        foreach ($request->getAnswers() as $answer)
        {
            $document->addAnswer($answer);
        }

        return $document;
    }
}