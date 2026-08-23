<?php

declare(strict_types=1);

namespace App\Enum\Core;

/**
 * @phpstan-require-implements \BackedEnum
 * @phpstan-require-implements HasLabel
 */
trait SearchableLabel
{
    /**
     * @return array<self>
     */
    public static function searchForLabel(string $label): array
    {
        return \array_filter(self::cases(), static function (HasLabel $enum) use ($label): bool {
            return false !== \stripos($enum->label(), $label);
        });
    }

    public static function findValuesForLabel(string $label): array
    {
        $cases = self::searchForLabel($label);

        return \array_map(static fn (\BackedEnum $enum) => $enum->value, $cases);
    }
}
