<?php

declare(strict_types=1);

namespace App\Exception\Icon;

use App\Enum\Icon\Icon;

class IconNotFoundException extends \Exception
{
    public static function forName(string $name): self
    {
        return new self(\sprintf(
            'L’icône « %s » n’est pas présente dans cette liste : « %s ».',
            $name,
            \implode(', ', Icon::names()),
        ));
    }
}
