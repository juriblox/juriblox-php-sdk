<?php

use JuriBlox\Sdk\Domain\Customers\Values\CustomerReference;

require __DIR__  . '/bootstrap.php';

$application = new Application();
$client = $application->getClient();

foreach ($client->documents()->findByCustomer(new CustomerReference('add7e40d-ca6f-11e5-a679-56166038df7d')) as $document)
{
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