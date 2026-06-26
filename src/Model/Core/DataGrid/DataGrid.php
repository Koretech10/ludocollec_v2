<?php

declare(strict_types=1);

namespace App\Model\Core\DataGrid;

use App\Collection\Core\DataGridHeaderCollection;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\Component\Form\FormView;

class DataGrid
{
    private PaginationInterface $pager;
    private ?FormView $filterType = null;
    private bool $isFiltered = false;

    public function __construct(
        public readonly DataGridHeaderCollection $headers,
    ) {
    }

    public function getPager(): PaginationInterface
    {
        return $this->pager;
    }

    public function setPager(PaginationInterface $pager): void
    {
        $this->pager = $pager;
    }

    public function getFilterType(): ?FormView
    {
        return $this->filterType;
    }

    public function setFilterType(FormView $filterType): void
    {
        $this->filterType = $filterType;
    }

    public function isFiltered(): bool
    {
        return $this->isFiltered;
    }

    public function setIsFiltered(bool $isFiltered): void
    {
        $this->isFiltered = $isFiltered;
    }
}
