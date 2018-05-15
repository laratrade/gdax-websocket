<?php

return [

    'url' => 'wss://ws-feed.gdax.com',

    'dns'     => '1.1.1.1',
    'timeout' => 5,

    'events' => [
        'ticker' => \Laratrade\GDAX\WebSocket\Events\TickReceived::class,
    ],

];
