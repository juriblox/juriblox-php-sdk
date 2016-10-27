<?php

use JuriBlox\Sdk\Domain\Documents\Values\DocumentReference;

require __DIR__ . '/bootstrap.php';

$application = new Application();
$client = $application->getClient();

foreach ($client->documents()->findByReference(new DocumentReference('Test')) as $document) {
    printTable([
        'ID'           => $document->getId(),
        'Title'        => $document->getTitle(),
        'Status'       => $document->getStatus(),
        'Reference'    => $document->getReference(),
        'Language'     => $document->getLanguage(),
        'Office'       => $document->getOffice(),
        'Tags'         => $document->getTags(),
        'Customer'     => $document->getCustomer(),
        'Alert date'   => $document->getAlertDate(),
        'Created date' => $document->getCreatedDatetime(),
    ], 'Document');
}
