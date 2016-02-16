<?php

use Dotenv\Dotenv;
use JuriBlox\Sdk\Client;
use JuriBlox\Sdk\Domain\Customers\Entities\Customer;
use JuriBlox\Sdk\Infrastructure\Drivers\GuzzleDriver;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = new Dotenv(__DIR__ . '/..');
$dotenv->load();

$client = new Client(new GuzzleDriver(getenv('JURIBLOX_CLIENT_ID'), getenv('JURIBLOX_CLIENT_KEY')), 'JuriBlox SDK Example');

/** @var Customer $customer */
foreach ($client->customers()->getAll() as $customer)
{
    printf("  - Reference: %s, company: %s, contact: %s\n", $customer->getReference(), $customer->getCompany(), $customer->getContact());
}