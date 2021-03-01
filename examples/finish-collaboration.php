<?php

use JuriBlox\Sdk\Domain\Documents\Entities\FinishDocumentCollaborationRequest;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentCollaborationId;

require __DIR__ . '/bootstrap.php';

$application = new Application();
$client = $application->getClient();

$collaborations = $client->collaborations();

$documentId = new DocumentCollaborationId('uuid');

$request = new FinishDocumentCollaborationRequest();
$request->setId($documentId);
$request->setMessage('Finished the collaboration');
$request->setForce(true);

$collaborations->finish($request);