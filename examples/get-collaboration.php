<?php


use JuriBlox\Sdk\Domain\Documents\Values\DocumentCollaborationId;

require __DIR__ . '/bootstrap.php';

$application = new Application();
$client = $application->getClient();

$collaborations = $client->collaborations();

$collaborationId = '';

$collaboration = $collaborations->findOneById(new DocumentCollaborationId($collaborationId));

printTable([
    'ID'    => $collaboration->getId(),
    'State' => $collaboration->getState(),
    'Is realtime' => $collaboration->isRealtime() ? 'Yes' : 'No',
    'Send emails' => $collaboration->sendEmails() ? 'Yes' : 'No',
    'Deadline' => $collaboration->getDeadline()->format('Y-m-d'),
    'Personal message' => $collaboration->getPersonalMessage(),
    'Started at' => $collaboration->getStartedAt()->format('Y-m-d H:i'),
], 'Collaboration');

foreach ($collaboration->getCollaborators() as $collaborator) {
    printTable([
        'ID' => $collaborator->getId(),
        'Type' => $collaborator->getType(),
        'State' => $collaborator->getState(),
        'Name' => $collaborator->getName(),
        'Email' => $collaborator->getEmail(),
        'URL' => $collaborator->getUrl(),
        'Can edit' => $collaborator->canEdit() ? 'Yes' : 'No',
        'Can suggest' => $collaborator->canSuggest() ? 'Yes' : 'No',
        'Can comment' => $collaborator->canComment() ? 'Yes' : 'No',
    ], 'Collaborator');
}