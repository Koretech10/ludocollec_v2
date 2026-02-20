<?php

declare(strict_types=1);

namespace App\Twig\Component\Core;

use App\Collection\Core\DataGridHeaderCollection;
use App\Model\Core\DataGrid\DataGrid as DataGridModel;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'data-grid')]
class DataGrid
{
    public DataGridModel $dataGrid;
    public bool $hideActions = false;

    public function getPager(): PaginationInterface
    {
        return $this->dataGrid->pager;
    }

    public function getHeaders(): DataGridHeaderCollection
    {
        return $this->dataGrid->headers;
    }
}
