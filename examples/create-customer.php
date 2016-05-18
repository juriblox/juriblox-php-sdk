<?php

use JuriBlox\Sdk\Domain\Customers\Entities\Customer;
use JuriBlox\Sdk\Domain\Customers\Values\Contact;

require __DIR__  . '/bootstrap.php';

$application = new Application();
$client = $application->getClient();

$customer = new Customer();
$customer->setCompany('TEST');
$customer->setContact(new Contact('Vic', 'vic@wijzijnmiddag.nl'));

$client->customers()->create($customer);