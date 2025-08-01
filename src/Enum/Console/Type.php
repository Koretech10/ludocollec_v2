<?php

declare(strict_types=1);

namespace App\Enum\Console;

use App\Enum\LabeledEnum;

enum Type: int implements LabeledEnum
{
    case HOME = 1;
    case HANDHELD = 2;
    case HYBRID = 3;
    case MICROCOMPUTER = 4;
    case OPERATING_SYSTEM = 5;
    case ARCADE = 6;
    case PERIPHERAL = 7;

    public function label(): string
    {
        return match ($this) {
            self::HOME => 'Console de salon',
            self::HANDHELD => 'Console portable',
            self::HYBRID => 'Console hybride',
            self::MICROCOMPUTER => 'Micro-ordinateur',
            self::OPERATING_SYSTEM => 'Système d’exploitation',
            self::ARCADE => 'Arcade',
            self::PERIPHERAL => 'Périphérique',
        };
    }
}
