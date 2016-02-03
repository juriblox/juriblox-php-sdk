<?php

namespace JuriBlox\Sdk\Values\Documents;

use JuriBlox\Sdk\Assertion;

class QuestionType
{
    /**
     * Radio button
     */
    const TYPE_RADIO = 'radio';

    /**
     * Short text input field
     */
    const TYPE_SHORT_TEXT = 'short_text';

    /**
     * Available question types
     *
     * @var array
     */
    public static $types = [
        self::TYPE_RADIO        => 'Radio button',
        self::TYPE_SHORT_TEXT   => 'Short text input'
    ];

    /**
     * @var string
     */
    private $type;

    /**
     * QuestionType constructor
     *
     * @param $type
     */
    public function __construct($type)
    {
        Assertion::keyExists(static::$types, $type);

        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getType();
    }
}