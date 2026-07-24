<?php

declare(strict_types=1);

namespace App\Enum\Core;

enum Direction: string
{
    case top = 'top';
    case right = 'right';
    case bottom = 'bottom';
    case left = 'left';
}
