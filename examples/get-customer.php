<?php

use JuriBlox\Sdk\Domain\Customers\Values\CustomerReference;

require __DIR__ . '/bootstrap.php';

$application = new Application();
$client = $application->getClient();

$customer = $client->customers()->findOneByReference(new CustomerReference('add7e40d-ca6f-11e5-a679-56166038df7d'));

printTable([
    'Reference'     => $customer->getReference(),
    'Company'       => $customer->getCompany(),
    'Contact'       => $customer->getContact(),
]);
