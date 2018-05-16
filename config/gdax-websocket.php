<?php

return [

    'url' => 'wss://ws-feed.gdax.com',

    'dns'     => '1.1.1.1',
    'timeout' => 5,

    'products' => [
        'BTC-USD',
        'BTC-GBP',
        'BTC-EUR',
        'BCH-USD',
        'BCH-BTC',
        'BCH-EUR',
        'ETH-USD',
        'ETH-EUR',
        'ETH-BTC',
        'LTC-USD',
        'LTC-EUR',
        'LTC-BTC',
    ],

    'channels' => [
        'ticker',
    ],

    'events' => [
        'ticker' => \Laratrade\GDAX\WebSocket\Events\TickReceived::class,
    ],

];
