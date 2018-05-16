<?php

namespace Laratrade\GDAX\WebSocket\Enums;

use Nasyrov\Laravel\Enums\Enum;

/**
 * @method static OrderStatusEnum OPEN()
 * @method static OrderStatusEnum PENDING()
 * @method static OrderStatusEnum ACTIVE()
 */
class OrderStatusEnum extends Enum
{
    const OPEN = 'open';
    const PENDING = 'pending';
    const ACTIVE = 'active';
}
