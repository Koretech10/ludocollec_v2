<?php

declare(strict_types=1);

namespace App\Twig\Component\Core;

use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('data-grid-pagination')]
class DataGridPagination
{
    public PaginationInterface $pager;
    public string $filterModalId;

    public function getFirstResultNumber(): int
    {
        $itemsPerPage = $this->pager->getItemNumberPerPage();
        $page = $this->pager->getCurrentPageNumber();

        return ($itemsPerPage * $page) - ($itemsPerPage - 1);
    }

    public function getLastResultNumber(): int
    {
        $count = $this->pager->count();

        return $this->getFirstResultNumber() + $count - 1;
    }

    public function getTotalItemCount(): int
    {
        return $this->pager->getTotalItemCount();
    }
}
