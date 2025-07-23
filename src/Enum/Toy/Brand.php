<?php

declare(strict_types=1);

namespace App\Enum\Toy;

use App\Enum\LabeledEnum;

enum Brand: int implements LabeledEnum
{
    case AMIIBO = 1;
    case SKYLANDERS = 2;
    case DISNEY_INFINITY = 3;
    case LEGO_DIMENSIONS = 4;
    case STARLINK = 5;

    public function label(): string
    {
        return match ($this) {
            self::AMIIBO => 'amiibo',
            self::SKYLANDERS => 'Skylanders',
            self::DISNEY_INFINITY => 'Disney Infinity',
            self::LEGO_DIMENSIONS => 'LEGO Dimensions',
            self::STARLINK => 'Starlink',
        };
    }
}
