<?php

declare(strict_types=1);

namespace App\Util\DataGrid;

use Knp\Component\Pager\Pagination\PaginationInterface;

readonly class DataGrid
{
    public function __construct(public PaginationInterface $pager)
    {
    }
}
