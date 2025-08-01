<?php

declare(strict_types=1);

namespace App\Enum\User;

enum DisplayListType: int
{
    case CARD_GRID = 1;
    case IMAGED_TABLE = 2;
    case TEXT_TABLE = 3;
}
