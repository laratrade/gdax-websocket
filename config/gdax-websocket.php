<?php

use Laratrade\GDAX\WebSocket\Events\TickReceived;

return [

    'dns'     => '1.1.1.1',
    'timeout' => 5,

    'events' => [
        'ticker' => TickReceived::class,
    ],

];
