<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use JuriBlox\Sdk\Validation\Assertion;

class QuestionType
{
    /**
     *
     */
    const TYPE_SHORT_TEXT = 'short_text';

    /**
     *
     */
    const TYPE_LONG_TEXT = 'long_text';

    /**
     *
     */
    const TYPE_COC = 'kvk';

    /**
     *
     */
    const TYPE_PRICE = 'price';

    /**
     *
     */
    const TYPE_NUMERIC = 'numeric';

    /**
     *
     */
    const TYPE_DATE = 'date';

    /**
     *
     */
    const TYPE_YES_NO = 'yes_no';

    /**
     *
     */
    const TYPE_STATEMENT = 'statement';

    /**
     *
     */
    const TYPE_RADIO = 'radio';

    /**
     *
     */
    const TYPE_SELECTBOX = 'selectbox';

    /**
     *
     */
    const TYPE_CHECKBOX = 'checkbox';

    /**
     *
     */
    const TYPE_INFOBOX = 'infobox';

    /**
     * Available question types.
     *
     * @var array
     */
    public static $types = [
        self::TYPE_SHORT_TEXT   => 'Short text input',
        self::TYPE_LONG_TEXT    => 'Long text input',
        self::TYPE_COC          => 'Chamber of Commerce registration number',
        self::TYPE_PRICE        => 'Price',
        self::TYPE_NUMERIC      => 'Numeric',
        self::TYPE_DATE         => 'Date',
        self::TYPE_YES_NO       => 'Boolean (yes/no)',
        self::TYPE_STATEMENT    => 'Statement',
        self::TYPE_RADIO        => 'Radio button',
        self::TYPE_SELECTBOX    => 'Selectbox',
        self::TYPE_CHECKBOX     => 'Checkbox',
        self::TYPE_INFOBOX      => 'Information box'
    ];

    /**
     * @var string
     */
    private $type;

    /**
     * QuestionType constructor.
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
    public function __toString()
    {
        return (string) $this->getType();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
