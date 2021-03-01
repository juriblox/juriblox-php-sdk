<?php

use JuriBlox\Sdk\Domain\Documents\Entities\DocumentCollaboration;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentCollaborationId;

require __DIR__ . '/bootstrap.php';

$application = new Application();
$client = $application->getClient();

$collaborations = $client->collaborations();

$documentId = new DocumentCollaborationId('uuid');

$collaboration = new DocumentCollaboration();
$collaboration->setId($documentId);

$collaborations->abort($collaboration);