<?php

use JuriBlox\Sdk\Domain\Customers\Entities\Customer;
use JuriBlox\Sdk\Domain\Customers\Values\Contact;

require __DIR__ . '/bootstrap.php';

$application = new Application();
$client = $application->getClient();

$customer = Customer::fromReferenceString('add7e40d-ca6f-11e5-a679-56166038df7d');
$customer->setCompany('MIDDAG');
$customer->setContact(new Contact('Vic', 'vic@wijzijnmiddag.nl'));

$client->customers()->update($customer);
