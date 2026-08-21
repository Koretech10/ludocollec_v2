<?php

declare(strict_types=1);

namespace App\Enum\Core;

trait SearchableLabel
{
    /**
     * @return array<self>
     */
    public static function searchFromLabel(string $label): array
    {
        return \array_filter(self::cases(), static function (HasLabel $enum) use ($label): bool {
            return false !== \stripos($enum->label(), $label);
        });
    }
}
