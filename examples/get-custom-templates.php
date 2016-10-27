<?php

use JuriBlox\Sdk\Domain\Documents\Entities\Template;

require __DIR__ . '/bootstrap.php';

$application = new Application();
$client = $application->getClient();

/** @var Template $template */
foreach ($client->customTemplates()->findAll() as $template) {
    printf("Template ID: %s, name: %s, version: %s, tags: %d, variables: %d, definitions: %d\n", $template->getId(), $template->getName(), $template->getRevision()->getVersion(), count($template->getTags()), count($template->getVariables()), count($template->getDefinitions()));
}
