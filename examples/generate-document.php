<?php

use JuriBlox\Sdk\Client;
use JuriBlox\Sdk\Domain\Customers\Values\CustomerReference;
use JuriBlox\Sdk\Domain\Documents\Entities\DocumentRequest;
use JuriBlox\Sdk\Domain\Documents\Entities\QuestionAnswer;
use JuriBlox\Sdk\Domain\Documents\Values\DocumentReference;
use JuriBlox\Sdk\Domain\Documents\Values\QuestionId;
use JuriBlox\Sdk\Domain\Documents\Values\TemplateId;
use JuriBlox\Sdk\Exceptions\EngineOperationException;
use JuriBlox\Sdk\Infrastructure\Drivers\GuzzleDriver;

require __DIR__ . '/bootstrap.php';

$client = new Client(new GuzzleDriver(getenv('JURIBLOX_CLIENT_ID'), getenv('JURIBLOX_CLIENT_KEY')), 'JuriBlox SDK Example');

$request = DocumentRequest::prepare(new TemplateId(634));
$request->setTitle('Document titel');
$request->setReference(new DocumentReference('Test SDK generation'));
$request->setCustomer(new CustomerReference('add7e40d-ca6f-11e5-a679-56166038df7d'));
$request->setRemarks('Aangevraagd op ' . date('r'));
$request->setAlertDate(new DateTime('01-12-2016'));

$answer = QuestionAnswer::createForQuestionId(new QuestionId(1100));
$answer->setValue('Voornaam');

$request->addAnswer($answer);

try
{
    $request = $client->documents()->generate($request);
}
catch (EngineOperationException $exception)
{
    print 'Exception: ' . $exception->getMessage() . "\n\n";
    print_r($exception->getErrors());

    exit();
}

printTable([
    'Request ID' => $request->getId(),
    'Title'      => $request->getTitle(),
    'Status'     => $request->getStatus(),
    'Reference'  => $request->getReference(),
    'Customer'   => $request->getCustomer(),
    'Remarks'    => $request->getRemarks(),
    'Alert date' => $request->getAlertDate(),
], 'Document generation request');