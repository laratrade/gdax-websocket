<?php

namespace Laratrade\GDAX\WebSocket\Enums;

use Nasyrov\Laravel\Enums\Enum;

/**
 * @method static GranularityEnum ONE_MIN()
 * @method static GranularityEnum FIVE_MIN()
 * @method static GranularityEnum FIFTEEN_MIN()
 * @method static GranularityEnum ONE_HOUR()
 * @method static GranularityEnum SIX_HOUR()
 * @method static GranularityEnum ONE_DAY()
 */
class GranularityEnum extends Enum
{
    const ONE_MIN = 60;
    const FIVE_MIN = 300;
    const FIFTEEN_MIN = 900;
    const ONE_HOUR = 3600;
    const SIX_HOUR = 21600;
    const ONE_DAY = 86400;
}
