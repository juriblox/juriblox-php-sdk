<?php

use JuriBlox\Sdk\Domain\Documents\Values\DocumentCollaborationId;

require __DIR__ . '/bootstrap.php';

$application = new Application();
$client = $application->getClient();

$collaborations = $client->collaborations();

$collaborationId = new DocumentCollaborationId('uuid');

$collaboration = $collaborations->findOneById($collaborationId);

$collaboration->setPersonalMessage('New personal message');

$collaborations->update($collaboration);