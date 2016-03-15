<?php

use JuriBlox\Sdk\Client;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentId;
use JuriBlox\Sdk\Infrastructure\Drivers\GuzzleDriver;

require __DIR__  . '/bootstrap.php';

$client = new Client(new GuzzleDriver(getenv('JURIBLOX_CLIENT_ID'), getenv('JURIBLOX_CLIENT_KEY')), 'JuriBlox SDK Example');

$document = $client->documents()->findOneById(new DocumentId(3833));

$table = [
    'ID'            => $document->getId(),
    'Reference'     => $document->getReference(),
    'Title'         => $document->getTitle(),
    'Tags'          => $document->getTags(),
    'Customer'      => $document->getCustomer(),
    'Created'       => $document->getCreatedDatetime(),
    'Alert'         => $document->getAlertDate()
];

printTable($table, 'Document properties');

foreach ($document->getAnswers() as $answer)
{
    $table = [

    ];

    printTable($table);
}