<?php

namespace JuriBlox\Sdk\Webhooks;

class RequestEvent
{
    /**
     * @var string
     */
    private $event;

    /**
     * RequestEvent constructor.
     *
     * @param $event
     */
    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * @return string
     */
    public function getString()
    {
        return $this->event;
    }
}
