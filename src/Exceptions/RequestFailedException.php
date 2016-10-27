<?php

namespace JuriBlox\Sdk\Exceptions;

use GuzzleHttp\Psr7\Response;

class RequestFailedException extends \Exception
{
    /**
     * Linked Response object.
     *
     * @var Response
     */
    protected $response;

    /**
     * Set the context for this exception so we know what Response caused it.
     *
     * @param Response $response
     *
     * @return RequestFailedException
     */
    public function setResponseContext(Response $response)
    {
        $this->response = $response;
        $this->loadResponseContext();

        return $this;
    }

    /**
     * Load the necessary information from the response context for this specific exception type.
     */
    protected function loadResponseContext()
    {
    }
}
