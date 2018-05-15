<?php

namespace Laratrade\GDAX\WebSocket\Events;

use stdClass;

class TickReceived
{
    /**
     * The tick payload.
     *
     * @var stdClass
     */
    public $payload;

    /**
     * Create a new event instance.
     *
     * @param stdClass $payload
     */
    public function __construct(stdClass $payload)
    {
        $this->payload = $payload;
    }
}
