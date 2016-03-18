<?php

use JuriBlox\Sdk\Client;
use JuriBlox\Sdk\Infrastructure\Drivers\GuzzleDriver;

require __DIR__  . '/bootstrap.php';

$client = new Client(new GuzzleDriver(getenv('JURIBLOX_CLIENT_ID'), getenv('JURIBLOX_CLIENT_KEY')), 'JuriBlox SDK Example');

foreach ($client->templates()->findAll() as $template)
{
    printTable([
        'ID'            => $template->getId(),
        'Name'          => $template->getName(),
        'Language'      => $template->getLanguage(),
        'Status'        => $template->getStatus(),
        'Version'       => $template->getRevision()->getVersion(),
        'Derived of #'  => $template->getRevision()->getDerivedOf()->getInteger(),
        'Description'   => $template->getDescription(),
        'Office'        => $template->getOffice(),
        'Last document' => $template->getLastDocument(),
        'Tags'          => $template->getTags(),
        'Variables'     => $template->getVariables(),
        'Definitions'   => $template->getDefinitions(),
        'Created at'    => $template->getCreatedDatetime(),
        'Created by'    => $template->getCreator()
    ], 'Template details');
}