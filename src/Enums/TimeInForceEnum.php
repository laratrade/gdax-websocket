<?php

namespace Laratrade\GDAX\WebSocket\Enums;

use Nasyrov\Laravel\Enums\Enum;

/**
 * @method static TimeInForceEnum GTC()
 * @method static TimeInForceEnum GTT()
 * @method static TimeInForceEnum IOC()
 * @method static TimeInForceEnum FOK()
 */
class TimeInForceEnum extends Enum
{
    const GTC = 'GTC';
    const GTT = 'GTT';
    const IOC = 'IOC';
    const FOK = 'FOK';
}
