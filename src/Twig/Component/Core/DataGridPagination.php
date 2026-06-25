<?php

declare(strict_types=1);

namespace App\Twig\Component\Core;

use App\Cookie\DisplayListTypeCookie;
use App\Enum\User\DisplayListType;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PostMount;

#[AsTwigComponent('data-grid-pagination')]
class DataGridPagination
{
    private DisplayListType $selectedDisplayListType;

    public PaginationInterface $pager;
    public string $filterModalId;
    public bool $hasFilterType;
    public bool $isFiltered;

    public function __construct(
        private readonly RequestStack $requestStack,
    ) {
    }

    #[PostMount]
    public function postMount(): void
    {
        $this->setSelectedDisplayListType();
    }

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

    public function getSelectedDisplayListType(): DisplayListType
    {
        return $this->selectedDisplayListType;
    }

    private function setSelectedDisplayListType(): void
    {
        $request = $this->requestStack->getCurrentRequest();

        if (null === $request) {
            return;
        }

        $displayListTypeCookie = $request->cookies->getInt(DisplayListTypeCookie::DISPLAY_LIST_COOKIE_NAME);

        $this->selectedDisplayListType = DisplayListType::from($displayListTypeCookie);
    }
}
