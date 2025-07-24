<?php

declare(strict_types=1);

namespace App\Enum\Extension;

use App\Enum\LabeledEnum;

enum Type:int implements LabeledEnum
{
    case ADD_ON = 1;
    case COSMETICS = 2;
    case PACK = 3;

    public function label(): string
    {
        return match ($this) {
            self::ADD_ON => 'Contenu additionnel',
            self::COSMETICS => 'Contenu cosmétique',
            self::PACK => 'Pack d’extensions',
        };
    }
}
