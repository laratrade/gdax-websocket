<?php

namespace Laratrade\GDAX\WebSocket\Enums;

use Nasyrov\Laravel\Enums\Enum;

/**
 * @method static ReportFormatEnum PDF()
 * @method static ReportFormatEnum CSV()
 */
class ReportFormatEnum extends Enum
{
    const PDF = 'pdf';
    const CSV = 'csv';
}
