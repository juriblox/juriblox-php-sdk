<?php

namespace JuriBlox\Sdk\Domain;

abstract class AbstractValue
{
    /**
     * Create a value object from an optional value, returning either NULL or a value object.
     *
     * @param $value
     *
     * @return null|static
     */
    public static function fromOptional($value)
    {
        if ($value == '' || $value === false) {
            return null;
        }

        return new static($value);
    }
}
