<?php

use JuriBlox\Sdk\Client;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentRequestId;
use JuriBlox\Sdk\Infrastructure\Drivers\GuzzleDriver;

require __DIR__ . '/bootstrap.php';

$application = new Application();
$client = $application->getClient();

$status = $client->documents()->getRequestStatus(new DocumentRequestId(17));

printTable([
    'Request ID'  => $status->getId(),
    'Document ID' => $status->getDocumentId() ? $status->getDocumentId()->getInteger() : null,
    'Status'      => $status->getStatus()
], 'Document request status');