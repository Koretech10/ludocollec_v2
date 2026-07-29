<?php

declare(strict_types=1);

namespace App\Enum\Core;

interface HasLabel
{
    public function label(): string;
}
