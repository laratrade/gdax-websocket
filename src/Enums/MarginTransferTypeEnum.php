<?php

namespace Laratrade\GDAX\WebSocket\Enums;

use Nasyrov\Laravel\Enums\Enum;

/**
 * @method static MarginTransferTypeEnum DEPOSIT()
 * @method static MarginTransferTypeEnum WITHDRAW()
 */
class MarginTransferTypeEnum extends Enum
{
    const DEPOSIT = 'deposit';
    const WITHDRAW = 'withdraw';
}
