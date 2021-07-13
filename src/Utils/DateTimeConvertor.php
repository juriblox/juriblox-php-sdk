<?php

namespace JuriBlox\Sdk\Utils;

class DateTimeConvertor
{
    /**
     * Convert a DateTime object to a string representation as expected by the vendor.
     *
     * @param \DateTime $dateTime
     *
     * @return string
     */
    public static function toVendorFormat(\DateTime $dateTime)
    {
        return $dateTime->format('d-m-Y');
    }
}
