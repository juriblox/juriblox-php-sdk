<?php

use Dotenv\Dotenv;
use JuriBlox\Sdk\Client;
use JuriBlox\Sdk\Domain\Documents\Entities\Template;
use JuriBlox\Sdk\Infrastructure\Drivers\GuzzleDriver;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = new Dotenv(__DIR__ . '/..');
$dotenv->load();

$client = new Client(new GuzzleDriver(getenv('JURIBLOX_CLIENT_ID'), getenv('JURIBLOX_CLIENT_KEY')), 'JuriBlox SDK Example');

/** @var Template $template */
foreach ($client->customTemplates()->findAll() as $template)
{
    printf("Template ID: %s, name: %s, version: %s, tags: %d, variables: %d, definitions: %d\n", $template->getId(), $template->getName(), $template->getRevision()->getVersion(), sizeof($template->getTags()), sizeof($template->getVariables()), sizeof($template->getDefinitions()));
}