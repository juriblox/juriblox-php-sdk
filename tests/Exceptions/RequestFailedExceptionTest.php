<?php

namespace JuriBlox\Sdk\Exceptions;

use GuzzleHttp\Psr7\Response;

class RequestFailedExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function test_with_valid_data()
    {
        $exception = new RequestFailedException();

        $this->assertInstanceOf(RequestFailedException::class, $exception->setResponseContext(new Response()));
    }
}
