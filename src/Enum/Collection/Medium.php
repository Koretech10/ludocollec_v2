<?php

declare(strict_types=1);

namespace App\Enum\Collection;

use App\Enum\Core\HasLabel;

enum Medium: int implements HasLabel
{
    case UNSPECIFIED = 0;
    case CARTRIDGE = 4;
    case TAPE = 1;
    case DIGITAL = 5;
    case DISC = 3;
    case FLOPPY = 2;

    public function label(): string
    {
        return match ($this) {
            self::UNSPECIFIED => 'Non renseigné',
            self::CARTRIDGE => 'Cartouche',
            self::TAPE => 'Cassette',
            self::DIGITAL => 'Dématérialisé',
            self::DISC => 'Disque',
            self::FLOPPY => 'Disquette',
        };
    }
}
