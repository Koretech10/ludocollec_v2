<?php

declare(strict_types=1);

namespace App\Collection\Core;

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
}
