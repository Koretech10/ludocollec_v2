<?php

declare(strict_types=1);

namespace App\Twig\Component\Core;

use App\Collection\Core\DataGridHeaderCollection;
use App\Cookie\DisplayListTypeCookie;
use App\Enum\User\DisplayListType;
use App\Model\Core\DataGrid\DataGrid as DataGridModel;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PostMount;

#[AsTwigComponent(name: 'data-grid')]
class DataGrid
{
    private string $filterModalId = 'filter_modal';
    private DisplayListType $displayListType;

    public DataGridModel $dataGrid;
    public bool $hideActions = false;

    public function __construct(
        private readonly RequestStack $requestStack,
    ) {
    }

    #[PostMount]
    public function postMount(): void
    {
        $this->setDisplayListType();
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

    private function setDisplayListType(): void
    {
        $request = $this->requestStack->getCurrentRequest();

        if (null === $request) {
            return;
        }

        $displayListCookie = $request->cookies->getInt(DisplayListTypeCookie::DISPLAY_LIST_COOKIE_NAME);

        $this->displayListType = DisplayListType::from($displayListCookie);
    }
}
