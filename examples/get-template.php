<?php

use JuriBlox\Sdk\Domain\Documents\Values\TemplateId;

require __DIR__ . '/bootstrap.php';

$application = new Application();
$client = $application->getClient();

$templateId = new TemplateId(630);

/*
 * Template details
 */
//$template = $client->templates()->findOneById($templateId);
//
//printTable([
//    'ID'            => $template->getId(),
//    'Name'          => $template->getName(),
//    'Language'      => $template->getLanguage(),
//    'Status'        => $template->getStatus(),
//    'Version'       => $template->getRevision()->getVersion(),
//    'Derived of #'  => $template->getRevision()->getDerivedOf()->getId(),
//    'Description'   => $template->getDescription(),
//    'Office'        => $template->getOffice(),
//    'Last document' => $template->getLastDocument(),
//    'Tags'          => $template->getTags(),
//    'Variables'     => $template->getVariables(),
//    'Definitions'   => $template->getDefinitions(),
//    'Created at'    => $template->getCreatedDatetime(),
//    'Created by'    => $template->getCreator()
//]);

/*
 * Questionnaire
 */
$steps = $client->templates()->questionnaire($templateId)->get();
foreach ($steps as $step) {
    printTable([
        'ID'            => $step->getId(),
        'Name'          => $step->getName(),
        'Description'   => $step->getDescription(),
    ], 'Step details');

    foreach ($step->getQuestions() as $question) {
        printTable([
            'ID'    => $question->getId(),
            'Name'  => $question->getName(),
            'Type'  => $question->getType(),
            'Info'  => $question->getInfo(),
        ], get_class($question), 1);

        // Options
        foreach ($question->getOptions() as $option) {
            printTable([
                'ID'    => $option->getId(),
                'Value' => $option->getValue(),
            ], 'Value', 2);
        }

        // Conditions
        foreach ($question->getConditions() as $condition) {
            printTable([
                'ID'    => $condition->getId(),
                'Value' => $condition->getValue(),
            ], 'Condition', 2);
        }
    }
}
