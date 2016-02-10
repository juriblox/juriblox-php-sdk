<?php

namespace JuriBlox\Sdk\Exceptions;

use GuzzleHttp\Psr7\Response;

class RateLimitingException extends RequestFailedException
{
    const HEADER_LIMIT_RESET = 'X-Rate-Limit-Reset';

    const HEADER_REQUESTS_LIMIT = 'X-Rate-Limit-Limit';

    const HEADER_REQUESTS_REMAINING = 'X-Rate-Limit-Remaining';

    /**
     * Maximum number of requests
     *
     * @var int
     */
    private $requestsLimit;

    /**
     * Number of requests remaining till we reach the limit
     *
     * @var int
     */
    private $requestsRemaining;

    /**
     * Minutes until the request limit gets reset
     *
     * @var int
     */
    private $limitResetMinutes;

    /**
     * Get the number of minutes until the request limit gets reset
     *
     * @return int
     */
    public function getLimitResetMinutes()
    {
        return $this->limitResetMinutes;
    }

    /**
     * Get the timestamp the request limit gets reset
     *
     * @return \DateTime
     */
    public function getLimitResetTime()
    {
        $time = new \DateTime();
        $time->add(new \DateInterval('PT' . $this->getLimitResetMinutes() . 'M'));

        return $time;
    }

    /**
     * Get the maximim number of requests
     *
     * @return int
     */
    public function getRequestsLimit()
    {
        return $this->requestsLimit;
    }

    /**
     * Get the number of requests remaining till we reach the limit
     *
     * @return int
     */
    public function getRequestsRemaining()
    {
        return $this->requestsRemaining;
    }

    /**
     * {@inheritdoc}
     */
    public function loadResponseContext()
    {
        $this->requestsLimit = $this->response->getHeader(self::HEADER_REQUESTS_LIMIT)[0];
        $this->requestsRemaining = $this->response->getHeader(self::HEADER_REQUESTS_REMAINING)[0];
        $this->limitResetMinutes = $this->response->getHeader(self::HEADER_LIMIT_RESET)[0];
    }
}