<?php

declare(strict_types=1);

namespace App\Exception\Core;

class DataGridHeaderNotFoundException extends \Exception
{
    public static function forKey(string $key): self
    {
        return new self(\sprintf('Le DataGridHeader avec la clé « %s » n’existe pas.', $key));
    }
}
