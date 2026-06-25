<?php

declare(strict_types=1);

namespace App\Builder\Core\DataGrid;

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
        $defaultSortField = $this->getDefaultSortFieldName($config);

        $dataGrid = new DataGrid($config->headers);

        $this->setupFilterType($request, $config, $dataGrid);

        $paginator = $this->paginator->paginate(
            $config->queryBuilder,
            $request->query->getInt('page', 1),
            $config->limit,
            [
                'defaultSortFieldName' => $defaultSortField,
                'defaultSortDirection' => $config->defaultSortOrder,
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
