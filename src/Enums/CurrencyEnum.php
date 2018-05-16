<?php

namespace Laratrade\GDAX\WebSocket\Enums;

use Nasyrov\Laravel\Enums\Enum;

/**
 * @method static CurrencyEnum USD()
 * @method static CurrencyEnum GBP()
 * @method static CurrencyEnum EUR()
 * @method static CurrencyEnum BTC()
 * @method static CurrencyEnum BCH()
 * @method static CurrencyEnum ETH()
 * @method static CurrencyEnum LTC()
 */
class CurrencyEnum extends Enum
{
    const USD = 'USD';
    const GBP = 'GBP';
    const EUR = 'EUR';
    const BTC = 'BTC';
    const BCH = 'BCH';
    const ETH = 'ETH';
    const LTC = 'LTC';
}
