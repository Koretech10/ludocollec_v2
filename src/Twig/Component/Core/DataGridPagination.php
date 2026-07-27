<?php

declare(strict_types=1);

namespace App\Twig\Component\Core;

use App\Collection\Core\DataGridHeaderCollection;
use App\Enum\User\DisplayListType;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('data-grid-pagination')]
class DataGridPagination
{
    public DisplayListType $selectedDisplayListType;
    public PaginationInterface $pager;
    public string $filterModalId;
    public bool $hasFilterType;
    public bool $isFiltered;
    public DataGridHeaderCollection $headers;

    public function getFirstResultNumber(): int
    {
        if (0 === $this->getTotalItemCount()) {
            return 0;
        }

        $itemsPerPage = $this->pager->getItemNumberPerPage();
        $page = $this->pager->getCurrentPageNumber();

        return ($itemsPerPage * $page) - ($itemsPerPage - 1);
    }

    public function getLastResultNumber(): int
    {
        if (0 === $this->getTotalItemCount()) {
            return 0;
        }

        $count = $this->pager->count();

        return $this->getFirstResultNumber() + $count - 1;
    }

    public function getTotalItemCount(): int
    {
        return $this->pager->getTotalItemCount();
    }
}
