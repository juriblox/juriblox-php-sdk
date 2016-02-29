<?php

namespace JuriBlox\Sdk\Validation;

use Assert\Assertion as BaseAssertion;

/**
 * Extensions to the Assert library
 *
 * @author Vic D'Elfant <vicdelfant@midd.ag>
 *
 * METHODSTART
 * @method static void nullOrDateTimeString($value, $value2, $message = null, $propertyPath = null)
 * METHODEND
 */
class Assertion extends BaseAssertion
{
    protected static $exceptionClass = 'JuriBlox\Sdk\Exceptions\AssertionFailedException';

    const INVALID_DATETIME_INPUT = 1000;

    /**
     * Assert that value is a parsable DateTime string
     *
     * @param mixed $value
     * @param string|null $message
     * @param string|null $propertyPath
     * @return void
     * @throws \Assert\AssertionFailedException
     */
    public static function dateTimeString($value, $message = null, $propertyPath = null)
    {
        try
        {
            new \DateTime($value);
        }
        catch (\Exception $exception)
        {
            $message = sprintf(
                $message ?: 'Value "%s" is not a valid input string for the DateTime constructor.',
                self::stringify($value)
            );

            throw static::createException($value, $message, static::INVALID_DATETIME_INPUT, $propertyPath);
        }
    }
}