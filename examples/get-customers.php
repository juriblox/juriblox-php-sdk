<?php

use JuriBlox\Sdk\Client;
use JuriBlox\Sdk\Domain\Customers\Entities\Customer;
use JuriBlox\Sdk\Infrastructure\Drivers\GuzzleDriver;

require __DIR__  . '/bootstrap.php';

$client = new Client(new GuzzleDriver(getenv('JURIBLOX_CLIENT_ID'), getenv('JURIBLOX_CLIENT_KEY')), 'JuriBlox SDK Example');

foreach ($client->customers()->findAll() as $customer)
{
    printTable([
        'Reference'     => $customer->getReference(),
        'Company'       => $customer->getCompany(),
        'Contact'       => $customer->getContact()
    ], 'Customer details');
}