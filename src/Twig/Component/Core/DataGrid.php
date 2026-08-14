<?php

declare(strict_types=1);

namespace App\Twig\Component\Core;

use App\Collection\Core\DataGridActionCollection;
use App\Collection\Core\DataGridHeaderCollection;
use App\Enum\User\DisplayListType;
use App\Model\Core\DataGrid\DataGrid as DataGridModel;
use App\Model\Core\DataGrid\DataGridAction;
use App\Query\Core\GetDisplayListTypeQuery;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PostMount;

#[AsTwigComponent(name: 'data-grid')]
class DataGrid
{
    use HandleTrait;

    private string $filterModalId = 'filter_modal';
    private DisplayListType $displayListType;

    public DataGridModel $dataGrid;
    public bool $hideActions = false;

    public function __construct(
        private readonly UrlGeneratorInterface $urlGenerator,
        MessageBusInterface $queryBus,
    ) {
        $this->messageBus = $queryBus;
    }

    #[PostMount]
    public function postMount(): void
    {
        /** @var DisplayListType $displayListType */
        $displayListType = $this->handle(new GetDisplayListTypeQuery());

        $this->displayListType = $displayListType;
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
        return $this->displayListType;
    }

    public function getFilterType(): ?FormView
    {
        return $this->dataGrid->getFilterType();
    }

    public function hasFilterType(): bool
    {
        return null !== $this->dataGrid->getFilterType();
    }

    public function getActions(): DataGridActionCollection
    {
        return $this->dataGrid->actions;
    }

    public function getActionHref(DataGridAction $action, object $item): string
    {
        return $this->urlGenerator->generate($action->route, $action->resolveRouteParameters($item));
    }

    public function canShowAction(DataGridAction $action, object $item): bool
    {
        return $action->canShow($item);
    }
}
