<?php

declare(strict_types=1);

namespace App\Exception\Core;

class EntityNotManagedException extends \Exception
{
    public static function forEntityClass(string $entityClass): self
    {
        return new self(\sprintf('L’entité « %s » n’est pas gérée.', $entityClass));
    }
}
