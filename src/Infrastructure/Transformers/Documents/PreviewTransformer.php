<?php

namespace JuriBlox\Sdk\Infrastructure\Transformers\Documents;

use JuriBlox\Sdk\Domain\Documents\Entities\Preview;

class PreviewTransformer
{
    /**
     * @param object $dto
     *
     * @return Preview
     */
    public static function read($dto)
    {
        $preview = new Preview();

        $preview->setHtml($dto->html);
        $preview->setCss($dto->css);

        return $preview;
    }
}