<?php

declare(strict_types=1);

namespace App\Enum\User;

enum DisplayListType: int
{
    case CARD_GRID = 1;
    case IMAGED_TABLE = 2;
    case TEXT_TABLE = 3;

    public function isTable(): bool
    {
        return self::TEXT_TABLE === $this || self::IMAGED_TABLE === $this;
    }

    public function isImagedTable(): bool
    {
        return self::IMAGED_TABLE === $this;
    }
}
