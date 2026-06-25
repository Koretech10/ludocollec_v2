<?php

declare(strict_types=1);

namespace App\Collection\Core;

use App\Exception\Core\DataGridHeaderNotFoundException;
use App\Model\Core\DataGrid\DataGridHeader;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @extends ArrayCollection<int, DataGridHeader>
 */
class DataGridHeaderCollection extends ArrayCollection
{
    public function getHeadersWithKey(): self
    {
        return new self(\array_filter(
            $this->toArray(),
            static fn (DataGridHeader $header): bool => null !== $header->key)
        );
    }

    /**
     * @throws DataGridHeaderNotFoundException
     */
    public function getForKey(string $key): DataGridHeader
    {
        /** @var DataGridHeader|false $header */
        $header = $this->filter(
            static function (DataGridHeader $header) use ($key): bool {
                return $header->key === $key;
            }
        )->first();

        if (false === $header) {
            throw DataGridHeaderNotFoundException::forKey($key);
        }

        return $header;
    }
}
