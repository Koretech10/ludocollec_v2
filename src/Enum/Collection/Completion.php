<?php

declare(strict_types=1);

namespace App\Enum\Collection;

use App\Enum\Core\HasLabel;

enum Completion: int implements HasLabel
{
    case NOT_STARTED = 1;
    case IN_PROGRESS = 2;
    case FINISHED = 3;
    case COMPLETED = 4;
    case INFINITE = 5;

    public function label(): string
    {
        return match ($this) {
            self::NOT_STARTED => 'Non commencé',
            self::IN_PROGRESS => 'En cours',
            self::FINISHED => 'Terminé',
            self::COMPLETED => 'Complété à 100%',
            self::INFINITE => 'Infini',
        };
    }
}
