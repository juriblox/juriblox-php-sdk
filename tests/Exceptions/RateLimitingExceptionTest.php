<?php

namespace JuriBlox\Sdk\Exceptions;

use GuzzleHttp\Psr7\Response;

class RateLimitingExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Requests limit.
     */
    const REQUEST_LIMIT = 180;

    /**
     * Number of requests remaining.
     */
    const REQUEST_REMAINING = 20;

    /**
     * Minutes until the requests counter gets reset.
     */
    const REQUEST_LIMIT_RESET = 10;

    public function test_with_valid_data()
    {
        $mockResponse = $this->getMockBuilder(Response::class)->getMock();

        // Mock $exception->getRequestsLimit()
        $mockResponse->expects($this->at(0))
            ->method('getHeader')
            ->with(RateLimitingException::HEADER_REQUESTS_LIMIT)
            ->willReturn([self::REQUEST_LIMIT]);

        // Mock $exception->getRequestsRemaining()
        $mockResponse->expects($this->at(1))
            ->method('getHeader')
            ->with(RateLimitingException::HEADER_REQUESTS_REMAINING)
            ->willReturn([self::REQUEST_REMAINING]);

        // Mock $exception->getLimitResetMinutes()
        $mockResponse->expects($this->at(2))
            ->method('getHeader')
            ->with(RateLimitingException::HEADER_LIMIT_RESET)
            ->willReturn([self::REQUEST_LIMIT_RESET]);

        $exception = new RateLimitingException();
        $exception->setResponseContext($mockResponse);

        $this->assertEquals(self::REQUEST_LIMIT, $exception->getRequestsLimit());
        $this->assertEquals(self::REQUEST_REMAINING, $exception->getRequestsRemaining());
        $this->assertEquals(self::REQUEST_LIMIT_RESET, $exception->getLimitResetMinutes());

        $time = new \DateTime();
        $time->add(new \DateInterval('PT' . $exception->getLimitResetMinutes() . 'M'));

        $this->assertEquals($time, $exception->getLimitResetTime());
    }
}
