<?php

declare(strict_types=1);

namespace App\Exception\Core;

class InvalidDataGridHeaderCollectionException extends \Exception
{
    public static function noDefaultSort(): self
    {
        return new self('Cette collection de DataGridHeader n’a pas de tri par défaut.');
    }

    /**
     * @param array<int, string> $defaultSortFieldsLabel
     */
    public static function hasMultipleDefaultSort(array $defaultSortFieldsLabel): self
    {
        return new self(\sprintf(
            'Il y a plusieurs tri par défaut configurés (« %s »)',
            \implode(' », « ', $defaultSortFieldsLabel),
        ));
    }

    public static function defaultSortHasNoKey(string $label): self
    {
        return new self(\sprintf('Le tri par défaut « %s » n’a pas clé.', $label));
    }
}
