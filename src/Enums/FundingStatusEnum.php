<?php

namespace Laratrade\GDAX\WebSocket\Enums;

use Nasyrov\Laravel\Enums\Enum;

/**
 * @method static FundingStatusEnum OUTSTANDING()
 * @method static FundingStatusEnum SETTLED()
 * @method static FundingStatusEnum REJECTED()
 */
class FundingStatusEnum extends Enum
{
    const OUTSTANDING = 'outstanding';
    const SETTLED = 'settled';
    const REJECTED = 'rejected';
}
