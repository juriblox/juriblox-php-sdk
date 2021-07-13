<?php

require __DIR__ . '/bootstrap.php';

$application = new Application();
$client = $application->getClient();

$collaborations = $client->collaborations();

foreach ($client->collaborations()->findAll() as $collaboration) {
    printTable([
        'ID'    => $collaboration->getId(),
        'State' => $collaboration->getState(),
        'Is realtime' => $collaboration->isRealtime() ? 'Yes' : 'No',
        'Send emails' => $collaboration->sendEmails() ? 'Yes' : 'No',
        'Deadline' => $collaboration->getDeadline()->format('Y-m-d'),
        'Personal message' => $collaboration->getPersonalMessage(),
        'Started at' => $collaboration->getStartedAt()->format('Y-m-d H:i'),
    ], 'Collaboration');
}