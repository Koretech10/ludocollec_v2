<?php

declare(strict_types=1);

namespace App\Enum\Core;

use App\Entity\Toy\Toy;
use App\Exception\Core\EntityNotManagedException;

enum EntityToImageDir: string
{
    case TOYS = 'toys';

    /**
     * @throws EntityNotManagedException
     */
    public static function fromEntityClass(string $entityClass): self
    {
        return match ($entityClass) {
            Toy::class => self::TOYS,
            default => throw EntityNotManagedException::forEntityClass($entityClass),
        };
    }
}
