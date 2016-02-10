<?php

use Dotenv\Dotenv;
use JuriBlox\Sdk\Client;
use JuriBlox\Sdk\Entities\Template;
use JuriBlox\Sdk\Infrastructure\Drivers\GuzzleDriver;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = new Dotenv(__DIR__ . '/..');
$dotenv->load();

$client = new Client(new GuzzleDriver(getenv('JURIBLOX_CLIENT_ID'), getenv('JURIBLOX_CLIENT_KEY')), 'JuriBlox SDK Example');

/** @var Template $template */
foreach ($client->templates()->getAll() as $template)
{
    print_r($template);
}