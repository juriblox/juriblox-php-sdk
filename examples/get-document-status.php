<?php

use JuriBlox\Sdk\Client;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentRequestId;
use JuriBlox\Sdk\Infrastructure\Drivers\GuzzleDriver;

require __DIR__ . '/bootstrap.php';

$client = new Client(new GuzzleDriver(getenv('JURIBLOX_CLIENT_ID'), getenv('JURIBLOX_CLIENT_KEY')), 'JuriBlox SDK Example');

$status = $client->documents()->getRequestStatus(new DocumentRequestId(17));

printTable([
    'Request ID'  => $status->getId(),
    'Document ID' => $status->getDocumentId() ? $status->getDocumentId()->getInteger() : null,
    'Status'      => $status->getStatus()
], 'Document request status');