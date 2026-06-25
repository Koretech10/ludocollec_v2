<?php

declare(strict_types=1);

namespace App\Builder\Core\DataGrid;

use App\Form\Core\SortType;
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

    public function build(DataGridConfig $config, Request $request): DataGrid
    {
        $dataGrid = new DataGrid($config->headers);

        $this->setupFilterType($request, $config, $dataGrid);

        $this->setupSortType($request, $config, $dataGrid);

        $paginator = $this->paginator->paginate(
            $config->queryBuilder,
            $request->query->getInt('page', 1),
            $config->limit,
            [
                PaginatorInterface::DEFAULT_SORT_FIELD_NAME => $this->getDefaultSortFieldName($config),
                PaginatorInterface::DEFAULT_SORT_DIRECTION => $this->getDefaultSortOrder($config),
            ],
        );

        $dataGrid->setPager($paginator);

        return $dataGrid;
    }

    /**
     * Permets de récupérer l'alias racine si on ne l'a pas précisé.
     */
    private function getDefaultSortFieldName(DataGridConfig $config): string
    {
        $queryBuilder = $config->queryBuilder;

        if (!\str_contains($config->defaultSortField, '.')) {
            $rootAliases = $queryBuilder->getRootAliases();

            if ([] === $rootAliases) {
                throw new \LogicException('Aucun alias racine n’a été définie dans ce QueryBuilder.');
            }

            $rootAlias = $rootAliases[0];

            return \sprintf('%s.%s', $rootAlias, $config->defaultSortField);
        }

        return $config->defaultSortField;
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

    private function setupSortType(Request $request, DataGridConfig $config, DataGrid $dataGrid): void
    {
        $sortType = $this->formFactory->create(
            SortType::class,
            options: ['headers' => $config->headers]
        );
        $sortType->handleRequest($request);

        $dataGrid->setSortType($sortType->createView());
    }
}
