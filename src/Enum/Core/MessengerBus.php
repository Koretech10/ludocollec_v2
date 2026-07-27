<?php

declare(strict_types=1);

namespace App\Enum\Core;

enum MessengerBus: string
{
    case MESSAGE = 'message.bus';
    case QUERY = 'query.bus';
}
