<?php

namespace Laratrade\GDAX\Contracts\WebSocket;

interface Processor
{
    /**
     * Process the WebSocket data.
     *
     * @return void
     */
    public function process(): void;
}
