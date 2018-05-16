<?php

namespace Laratrade\GDAX\WebSocket\Enums;

use Nasyrov\Laravel\Enums\Enum;

/**
 * @method static ProductEnum BTC_USD()
 * @method static ProductEnum BTC_GBP()
 * @method static ProductEnum BTC_EUR()
 * @method static ProductEnum BCH_USD()
 * @method static ProductEnum BCH_BTC()
 * @method static ProductEnum BCH_EUR()
 * @method static ProductEnum ETH_USD()
 * @method static ProductEnum ETH_EUR()
 * @method static ProductEnum ETH_BTC()
 * @method static ProductEnum LTC_USD()
 * @method static ProductEnum LTC_EUR()
 * @method static ProductEnum LTC_BTC()
 */
class ProductEnum extends Enum
{
    const BTC_USD = 'BTC-USD';
    const BTC_GBP = 'BTC-GBP';
    const BTC_EUR = 'BTC-EUR';

    const BCH_USD = 'BCH-USD';
    const BCH_BTC = 'BCH-BTC';
    const BCH_EUR = 'BCH-EUR';

    const ETH_USD = 'ETH-USD';
    const ETH_EUR = 'ETH-EUR';
    const ETH_BTC = 'ETH-BTC';

    const LTC_USD = 'LTC-USD';
    const LTC_EUR = 'LTC-EUR';
    const LTC_BTC = 'LTC-BTC';
}
