<?php

declare(strict_types=1);

namespace App\Enum\User;

use App\Enum\Core\HasDefault;

enum DisplayListType: int implements HasDefault
{
    case CARD_GRID = 1;
    case IMAGED_TABLE = 2;
    case TEXT_TABLE = 3;

    public static function default(): self
    {
        return self::CARD_GRID;
    }

    public function isTable(): bool
    {
        return self::TEXT_TABLE === $this || self::IMAGED_TABLE === $this;
    }

    public function isCardGrid(): bool
    {
        return self::CARD_GRID === $this;
    }

    public function isImagedTable(): bool
    {
        return self::IMAGED_TABLE === $this;
    }

    public function isTextTable(): bool
    {
        return self::TEXT_TABLE === $this;
    }

    public static function fromCookie(int $value): self
    {
        if (null !== ($type = self::tryFrom($value))) {
            return $type;
        }

        return self::default();
    }
}
