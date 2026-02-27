<?php

declare(strict_types=1);

namespace App\Enum\Core;

enum Type: string
{
    case PRIMARY = 'primary';
    case SECONDARY = 'secondary';
    case SUCCESS = 'success';
    case INFO = 'info';
    case WARNING = 'warning';
    case DANGER = 'danger';
    case LIGHT = 'light';
    case DARK = 'dark';
}
