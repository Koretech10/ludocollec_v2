<?php

declare(strict_types=1);

namespace App\Enum\Collection;

use App\Enum\Core\LabeledEnum;

enum Region: int implements LabeledEnum
{
    case ASIA = 1;
    case NTSC_J = 2;
    case NTSC_U = 3;
    case PAL_AUSTRALIA = 4;
    case PAL_EUROPE = 5;
    case OTHER = 6;

    public function label(): string
    {
        return match ($this) {
            self::ASIA => 'Asie',
            self::NTSC_J => 'NTSC-J',
            self::NTSC_U => 'NTSC-U',
            self::PAL_AUSTRALIA => 'PAL Australie',
            self::PAL_EUROPE => 'PAL Europe',
            self::OTHER => 'Autre',
        };
    }
}
