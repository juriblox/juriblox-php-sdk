<?php

use JuriBlox\Sdk\Domain\Documents\Values\DocumentId;

require __DIR__ . '/bootstrap.php';

$application = new Application();
$client = $application->getClient();

$document = $client->documents()->findOneById(new DocumentId(3838));

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

// Answers
foreach ($document->getAnswers() as $answer) {
    printTable([
        'Question ID'   => $answer->getQuestion()->getId(),
        'Question name' => $answer->getQuestion()->getName(),

        'ID'       => $answer->getId(),
        'Variable' => $answer->getVariable(),
        'Value'    => $answer->getValue(),
    ], get_class($answer), 1);
}

// Files
foreach ($document->getFiles() as $file) {
    printTable([
        'Type'     => $file->getType(),
        'Filename' => $file->getFilename(),
        'URL'      => $file->getUrl(),
    ], get_class($file), 1);
}
