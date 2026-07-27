<?php

declare(strict_types=1);

namespace App\Twig\Component\Core;

use App\Collection\Core\DataGridHeaderCollection;
use App\Enum\User\DisplayListType;
use App\Model\Core\DataGrid\DataGrid as DataGridModel;
use App\Query\Core\GetDisplayListTypeQuery;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'data-grid')]
class DataGrid
{
    use HandleTrait;

    private string $filterModalId = 'filter_modal';

    public DataGridModel $dataGrid;
    public bool $hideActions = false;

    public function __construct(
        MessageBusInterface $queryBus,
    ) {
        $this->messageBus = $queryBus;
    }

    public function getPager(): PaginationInterface
    {
        return $this->dataGrid->getPager();
    }

    public function getHeaders(): DataGridHeaderCollection
    {
        return $this->dataGrid->headers;
    }

    public function getFilterModalId(): string
    {
        return $this->filterModalId;
    }

    public function getDisplayListType(): DisplayListType
    {
        /** @var DisplayListType */
        return $this->handle(new GetDisplayListTypeQuery());
    }

    public function getFilterType(): ?FormView
    {
        return $this->dataGrid->getFilterType();
    }

    public function hasFilterType(): bool
    {
        return null !== $this->dataGrid->getFilterType();
    }
}
