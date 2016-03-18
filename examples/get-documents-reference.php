<?php

use JuriBlox\Sdk\Client;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentReference;
use JuriBlox\Sdk\Infrastructure\Drivers\GuzzleDriver;

require __DIR__  . '/bootstrap.php';

$client = new Client(new GuzzleDriver(getenv('JURIBLOX_CLIENT_ID'), getenv('JURIBLOX_CLIENT_KEY')), 'JuriBlox SDK Example');

foreach ($client->documents()->findByReference(new DocumentReference('Test')) as $document)
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
}