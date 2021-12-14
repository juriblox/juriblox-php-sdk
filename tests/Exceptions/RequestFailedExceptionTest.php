<?php

namespace JuriBlox\Sdk\Exceptions;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class RequestFailedExceptionTest extends TestCase
{
    public function test_with_valid_data()
    {
        $exception = new RequestFailedException();

        $this->assertInstanceOf(RequestFailedException::class, $exception->setResponseContext(new Response()));
    }
}
