<?php

declare(strict_types=1);

namespace App\Model\Core\DataGrid;

use App\Collection\Core\DataGridActionCollection;
use App\Collection\Core\DataGridHeaderCollection;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Form\FormTypeInterface;

readonly class DataGridConfig
{
    private const int DEFAULT_LIMIT = 30;
    private const string DEFAULT_SORT_DIRECTION = 'ASC';

    public function __construct(
        public QueryBuilder $queryBuilder,
        public DataGridHeaderCollection $headers,
        public DataGridActionCollection $actions,
        public string $defaultSortOrder = self::DEFAULT_SORT_DIRECTION,
        public int $limit = self::DEFAULT_LIMIT,
        /** @var class-string<FormTypeInterface> */
        public ?string $filterType = null,
        /** @var array<string, mixed> */
        public array $filterOptions = [],
    ) {
    }
}
