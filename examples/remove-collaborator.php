<?php

use JuriBlox\Sdk\Domain\Documents\Values\DocumentCollaborationId;

require __DIR__ . '/bootstrap.php';

$application = new Application();
$client = $application->getClient();

$collaborations = $client->collaborations();

$collaborationId = new DocumentCollaborationId('uuid');

$collaboration = $collaborations->findOneById($collaborationId);

$collaboratorToRemove = $collaboration->getCollaborators()[0];

$collaborations->removeCollaborator($collaboration, $collaboratorToRemove);