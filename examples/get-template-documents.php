<?php

use JuriBlox\Sdk\Client;
use JuriBlox\Sdk\Domain\Documents\Values\TemplateId;
use JuriBlox\Sdk\Infrastructure\Drivers\GuzzleDriver;

require __DIR__ . '/bootstrap.php';

$client = new Client(new GuzzleDriver(getenv('JURIBLOX_CLIENT_ID'), getenv('JURIBLOX_CLIENT_KEY')), 'JuriBlox SDK Example');

foreach ($client->documents()->findWithTemplateId(new TemplateId(633)) as $document)
{
    printTable([
        'ID'           => $document->getId(),
        'Title'        => $document->getTitle(),
        'Reference'    => $document->getReference(),
        'Language'     => $document->getLanguage(),
        'Office'       => $document->getOffice(),
        'Tags'         => $document->getTags(),
        'Customer'     => $document->getCustomer(),
        'Alert date'   => $document->getAlertDate(),
        'Created date' => $document->getCreatedDatetime(),
    ], 'Document');

    // Answers
    foreach ($document->getAnswers() as $answer)
    {
        printTable([
            'Question ID'   => $answer->getQuestion()->getId(),
            'Question name' => $answer->getQuestion()->getName(),

            'ID'       => $answer->getId(),
            'Variable' => $answer->getVariable(),
            'Value'    => $answer->getValue()
        ], get_class($answer), 1);
    }

    // Files
    foreach ($document->getFiles() as $file)
    {
        printTable([
            'Type'     => $file->getType(),
            'Filename' => $file->getFilename(),
            'URL'      => $file->getUrl()
        ], get_class($file), 1);
    }
}