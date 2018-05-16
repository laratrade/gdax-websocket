<?php

namespace Laratrade\GDAX\WebSocket\Enums;

use Nasyrov\Laravel\Enums\Enum;

/**
 * @method static OrderSideEnum BUY()
 * @method static OrderSideEnum SELL()
 */
class OrderSideEnum extends Enum
{
    const BUY = 'buy';
    const SELL = 'sell';
}
