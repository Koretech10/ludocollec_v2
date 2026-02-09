<?php

declare(strict_types=1);

namespace App\Util\DataGrid;

use Doctrine\ORM\QueryBuilder;

readonly class DataGridConfig
{
    private const int DEFAULT_LIMIT = 25;
    private const string DEFAULT_SORT_FIELD = 'id';
    private const string DEFAULT_SORT_DIRECTION = 'ASC';

    public function __construct(
        public QueryBuilder $queryBuilder,
        public string $defaultSortField = self::DEFAULT_SORT_FIELD,
        public string $defaultSortOrder = self::DEFAULT_SORT_DIRECTION,
        public int $limit = self::DEFAULT_LIMIT,
    ) {
    }
}
