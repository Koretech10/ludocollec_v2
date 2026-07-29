<?php

declare(strict_types=1);

namespace App\Enum\Core;

interface HasDefault
{
    public static function default(): self;
}
