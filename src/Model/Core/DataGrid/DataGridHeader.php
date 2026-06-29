<?php

declare(strict_types=1);

namespace App\Model\Core\DataGrid;

readonly class DataGridHeader
{
    public function __construct(
        public string $label,
        public ?string $key = null,
        public bool $defaultSort = false,
    ) {
    }
}
