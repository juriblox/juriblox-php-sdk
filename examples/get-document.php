<?php

use Dotenv\Dotenv;
use JuriBlox\Sdk\Client;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentId;
use JuriBlox\Sdk\Infrastructure\Drivers\GuzzleDriver;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = new Dotenv(__DIR__ . '/..');
$dotenv->load();

$client = new Client(new GuzzleDriver(getenv('JURIBLOX_CLIENT_ID'), getenv('JURIBLOX_CLIENT_KEY')), 'JuriBlox SDK Example');

$document = $client->documents()->findOneById(new DocumentId(40));

print_r($document);