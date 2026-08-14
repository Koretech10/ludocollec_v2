<?php

declare(strict_types=1);

namespace App\Builder\Core\DataGrid;

use App\Exception\Core\InvalidDataGridHeaderCollectionException;
use App\Model\Core\DataGrid\DataGrid;
use App\Model\Core\DataGrid\DataGridConfig;
use Knp\Component\Pager\PaginatorInterface;
use Spiriit\Bundle\FormFilterBundle\Filter\FilterBuilderUpdaterInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

readonly class DataGridBuilder
{
    public function __construct(
        private PaginatorInterface $paginator,
        private FilterBuilderUpdaterInterface $filterBuilderUpdater,
        private FormFactoryInterface $formFactory,
    ) {
    }

    /**
     * @throws InvalidDataGridHeaderCollectionException
     */
    public function build(DataGridConfig $config, Request $request): DataGrid
    {
        $dataGrid = new DataGrid($config->headers, $config->actions);

        $this->setupFilterType($request, $config, $dataGrid);

        $defaultSortField = $config->headers->getDefaultSortKey();

        $paginator = $this->paginator->paginate(
            $config->queryBuilder,
            $request->query->getInt('page', 1),
            $config->limit,
            [
                PaginatorInterface::DEFAULT_SORT_FIELD_NAME => $defaultSortField,
                PaginatorInterface::DEFAULT_SORT_DIRECTION => $this->getDefaultSortOrder($config),
            ],
        );

        $dataGrid->setPager($paginator);

        return $dataGrid;
    }

    private function getDefaultSortOrder(DataGridConfig $config): string
    {
        return \strtolower($config->defaultSortOrder);
    }

    private function setupFilterType(Request $request, DataGridConfig $config, DataGrid $dataGrid): void
    {
        if (null !== $config->filterType) {
            $filterType = $this->formFactory->create($config->filterType, options: $config->filterOptions);
            $filterType->handleRequest($request);

            if ($filterType->isSubmitted() && $filterType->isValid()) {
                $this->filterBuilderUpdater->addFilterConditions($filterType, $config->queryBuilder);

                $dataGrid->setIsFiltered(true);
            }

            $dataGrid->setFilterType($filterType->createView());
        }
    }
}
