<?php

namespace Laratrade\GDAX\WebSocket\Enums;

use Nasyrov\Laravel\Enums\Enum;

/**
 * @method static OrderSideEnum GTC()
 * @method static OrderSideEnum GTT()
 * @method static OrderSideEnum IOC()
 * @method static OrderSideEnum FOK()
 */
class TimeInForceEnum extends Enum
{
    const GTC = 'GTC';
    const GTT = 'GTT';
    const IOC = 'IOC';
    const FOK = 'FOK';
}
