<?php

namespace JuriBlox\Sdk\Infrastructure\Downloaders;

use JuriBlox\Sdk\Domain\Documents\Values\DocumentId;
use JuriBlox\Sdk\Domain\Documents\Values\FileType;
use JuriBlox\Sdk\Exceptions\DocumentDownloadException;
use JuriBlox\Sdk\Infrastructure\Drivers\DriverInterface;

abstract class DocumentDownloader
{
    /**
     * Download a document.
     *
     * @param DriverInterface $driver
     * @param DocumentId      $documentId
     * @param FileType        $type
     *
     * @return string
     */
    public static function download(DriverInterface $driver, DocumentId $documentId, FileType $type)
    {
        try {
            $contents = $driver->getRaw('documents/{documentId}/download/{extension}', [
                'documentId' => $documentId,
                'extension'  => $type->getExtension(),
            ]);
        } catch (\Exception $exception) {
            throw new DocumentDownloadException($exception->getMessage(), $exception->getCode(), $exception);
        }

        return base64_decode($contents);
    }
}
