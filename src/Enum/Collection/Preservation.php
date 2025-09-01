<?php

declare(strict_types=1);

namespace App\Enum\Collection;

use App\Enum\Core\LabeledEnum;

enum Preservation: int implements LabeledEnum
{
    case NEW = 1;
    case LIKE_NEW = 2;
    case VERY_GOOD = 3;
    case GOOD = 4;
    case AVERAGE = 5;
    case DAMAGED = 6;
    case OUT_OF_SERVICE = 7;
    case DIGITAL = 8;

    public function label(): string
    {
        return match ($this) {
            self::NEW => 'Neuf sous blister',
            self::LIKE_NEW => 'Comme neuf',
            self::VERY_GOOD => 'Très bon état',
            self::GOOD => 'Bon état',
            self::AVERAGE => 'État moyen',
            self::DAMAGED => 'Abîmé',
            self::OUT_OF_SERVICE => 'Hors service',
            self::DIGITAL => 'Dématérialisé',
        };
    }
}
