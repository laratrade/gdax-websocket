<?php

namespace Laratrade\GDAX\WebSocket\Enums;

use Nasyrov\Laravel\Enums\Enum;

/**
 * @method static ReportTypeEnum FILLS()
 * @method static ReportTypeEnum ACCOUNT()
 */
class ReportTypeEnum extends Enum
{
    const FILLS = 'fills';
    const ACCOUNT = 'account';
}
