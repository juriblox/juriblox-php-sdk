<?php

use JuriBlox\Sdk\Domain\Documents\Entities\DocumentCollaborator;
use JuriBlox\Sdk\Domain\Documents\Entities\StartDocumentCollaborationRequest;

require __DIR__ . '/bootstrap.php';

$application = new Application();
$client = $application->getClient();

$collaborations = $client->collaborations();

$request = new StartDocumentCollaborationRequest();
$request->setDeadline(new DateTime('tomorrow'));
$request->setPersonalMessage('Personal message');
$request->setRealtime(true);
$request->setSendEmails(true);

$collaborator = new DocumentCollaborator();
$collaborator->setEmail('email@collaborator.com');
$collaborator->setName('Collaborator name');
$collaborator->setType('external');
$collaborator->setComment(true);
$collaborator->setEdit(false);
$collaborator->setSuggest(true);

$request->addCollaborator($collaborator);

$collaborations->store($request);