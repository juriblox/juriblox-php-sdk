<?php

use JuriBlox\Sdk\Domain\Documents\Values\DocumentId;
use JuriBlox\Sdk\Domain\Documents\Values\FileType;
use JuriBlox\Sdk\Infrastructure\Downloaders\DocumentDownloader;

require __DIR__ . '/bootstrap.php';

$application = new Application();

$documentId = new DocumentId(3839);

file_put_contents(sprintf('downloads/Document-%d.pdf', $documentId->getInteger()), DocumentDownloader::download($application->getDriver(), $documentId, new FileType(FileType::TYPE_PDF)));
file_put_contents(sprintf('downloads/Document-%d.docx', $documentId->getInteger()), DocumentDownloader::download($application->getDriver(), $documentId, new FileType(FileType::TYPE_WORD2007)));
