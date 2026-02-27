<?php

declare(strict_types=1);

namespace App\Builder\Core\DataGrid;

use App\Model\Core\DataGrid\DataGrid;
use App\Model\Core\DataGrid\DataGridConfig;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

readonly class DataGridBuilder
{
    public function __construct(
        private PaginatorInterface $paginator,
    ) {
    }

    public function build(DataGridConfig $config, Request $request): DataGrid
    {
        $defaultSortField = $this->getDefaultSortFieldName($config);

        $paginator = $this->paginator->paginate(
            $config->queryBuilder,
            $request->query->getInt('page', 1),
            $config->limit,
            [
                'defaultSortFieldName' => $defaultSortField,
                'defaultSortDirection' => $config->defaultSortOrder,
            ],
        );

        return new DataGrid($paginator, $config->headers);
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
}
