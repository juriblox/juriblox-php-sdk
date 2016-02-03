<?php

namespace JuriBlox\Sdk;

use Assert\Assertion as BaseAssertion;

class Assertion extends BaseAssertion
{
    protected static $exceptionClass = 'JuriBlox\Sdk\Exceptions\AssertionFailedException';
}