<?php

use JuriBlox\Sdk\Client;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentReference;
use JuriBlox\Sdk\Infrastructure\Drivers\GuzzleDriver;

require __DIR__  . '/bootstrap.php';

$client = new Client(new GuzzleDriver(getenv('JURIBLOX_CLIENT_ID'), getenv('JURIBLOX_CLIENT_KEY')), 'JuriBlox SDK Example');

/** @var Document $document */
foreach ($client->documents()->findByReference(new DocumentReference('1234')) as $document)
{
    print_r($document);
}