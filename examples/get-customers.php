<?php

require __DIR__ . '/bootstrap.php';

$application = new Application();
$client = $application->getClient();

foreach ($client->customers()->findAll() as $customer) {
    printTable([
        'Reference'     => $customer->getReference(),
        'Company'       => $customer->getCompany(),
        'Contact'       => $customer->getContact(),
    ], 'Customer details');
}
