<?php

declare(strict_types=1);

namespace App\Enum\Core;

enum Type: string implements HasIcon
{
    case PRIMARY = 'primary';
    case SECONDARY = 'secondary';
    case SUCCESS = 'success';
    case INFO = 'info';
    case WARNING = 'warning';
    case DANGER = 'danger';
    case LIGHT = 'light';
    case DARK = 'dark';

    public function icon(): Icon
    {
        return match ($this) {
            self::SUCCESS => Icon::validate,
            self::WARNING => Icon::warning,
            self::DANGER => Icon::danger,
            default => Icon::info,
        };
    }
}
