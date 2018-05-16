<?php

namespace Laratrade\GDAX\WebSocket\Enums;

use Nasyrov\Laravel\Enums\Enum;

/**
 * @method static CancelAfterEnum MIN()
 * @method static CancelAfterEnum HOUR()
 * @method static CancelAfterEnum DAY()
 */
class CancelAfterEnum extends Enum
{
    const MIN = 'min';
    const HOUR = 'hour';
    const DAY = 'day';
}
