<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use JuriBlox\Sdk\Validation\Assertion;

class DocumentRequestStatus
{
    /**
     * Document has successfully been requested
     */
    const STATUS_REQUESTED = 200;

    /**
     * Available statuses
     *
     * @var array
     */
    public static $statuses = [
        self::STATUS_REQUESTED => 'Requested'
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