<?php

namespace Laratrade\GDAX\WebSocket\Enums;

use Nasyrov\Laravel\Enums\Enum;

/**
 * @method static OrderTypeEnum LIMIT()
 * @method static OrderTypeEnum MARKET()
 * @method static OrderTypeEnum STOP()
 */
class OrderTypeEnum extends Enum
{
    const LIMIT = 'limit';
    const MARKET = 'market';
    const STOP = 'stop';
}
