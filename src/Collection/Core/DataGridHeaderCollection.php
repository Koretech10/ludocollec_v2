<?php

declare(strict_types=1);

namespace App\Collection\Core;

use App\Exception\Core\InvalidDataGridHeaderCollectionException;
use App\Model\Core\DataGrid\DataGridHeader;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @extends ArrayCollection<int, DataGridHeader>
 */
class DataGridHeaderCollection extends ArrayCollection
{
    /**
     * @return array<int, string>
     */
    public function getLabels(): array
    {
        return \array_map(static fn (DataGridHeader $header): string => $header->label, $this->toArray());
    }

    /**
     * @throws InvalidDataGridHeaderCollectionException
     */
    public function getDefaultSortKey(): string
    {
        $defaultSortHeaders = $this->filter(static fn (DataGridHeader $header): bool => true === $header->defaultSort);

        if ($defaultSortHeaders->isEmpty()) {
            throw InvalidDataGridHeaderCollectionException::noDefaultSort();
        }

        if (1 < $defaultSortHeaders->count()) {
            throw InvalidDataGridHeaderCollectionException::hasMultipleDefaultSort($defaultSortHeaders->getLabels());
        }

        $defaultSortHeader = $defaultSortHeaders->first();

        if (null === $defaultSortHeader->key) {
            throw InvalidDataGridHeaderCollectionException::defaultSortHasNoKey($defaultSortHeader->label);
        }

        return $defaultSortHeader->key;
    }
}
