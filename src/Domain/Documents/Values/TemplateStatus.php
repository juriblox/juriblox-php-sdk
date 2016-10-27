<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use JuriBlox\Sdk\Validation\Assertion;

class TemplateStatus
{
    /**
     * Template has been published.
     */
    const STATUS_PUBLISHED = 1;

    /**
     * Available statuses.
     *
     * @var array
     */
    public static $statuses = [
        self::STATUS_PUBLISHED => 'Published',
    ];

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * @param $code
     * @param $name
     */
    public function __construct($code, $name)
    {
        Assertion::keyExists(static::$statuses, $code);

        $this->code = $code;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s [%d]', $this->getName(), $this->getCode());
    }

    /**
     * @param $code
     *
     * @return TemplateStatus
     */
    public static function fromCode($code)
    {
        Assertion::keyExists(static::$statuses, $code);

        return new static($code, self::$statuses[$code]);
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
