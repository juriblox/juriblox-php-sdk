<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use JuriBlox\Sdk\Validation\Assertion;

class DocumentStatus
{
    /**
     * Document has successfully been generated
     */
    const STATUS_GENERATED = 200;

    /**
     * Document is pending generation
     */
    const STATUS_PENDING = 202;

    /**
     * Document generation failed
     */
    const STATUS_FAILED = 500;

    /**
     * Available statuses
     *
     * @var array
     */
    public static $statuses = [
        self::STATUS_PENDING    => 'Pending',
        self::STATUS_GENERATED  => 'Generated',
        self::STATUS_FAILED     => 'Failed'
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
     *
     * @return DocumentStatus
     */
    public static function fromCode($code)
    {
        Assertion::keyExists(static::$statuses, $code);

        return new static($code, self::$statuses[$code]);
    }

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