<?php

declare(strict_types=1);

namespace App\Model\Core\DataGrid;

use App\Collection\Core\DataGridHeaderCollection;
use Knp\Component\Pager\Pagination\PaginationInterface;

readonly class DataGrid
{
    public function __construct(
        public PaginationInterface $pager,
        public DataGridHeaderCollection $headers,
    ) {
    }
}
