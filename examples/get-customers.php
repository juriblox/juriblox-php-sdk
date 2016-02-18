<?php

use JuriBlox\Sdk\Client;
use JuriBlox\Sdk\Domain\Customers\Entities\Customer;
use JuriBlox\Sdk\Infrastructure\Drivers\GuzzleDriver;

require __DIR__  . '/bootstrap.php';

$client = new Client(new GuzzleDriver(getenv('JURIBLOX_CLIENT_ID'), getenv('JURIBLOX_CLIENT_KEY')), 'JuriBlox SDK Example');

/** @var Customer $customer */
foreach ($client->customers()->findAll() as $customer)
{
    printf("  - Reference: %s, company: %s, contact: %s\n", $customer->getReference(), $customer->getCompany(), $customer->getContact());
}