<?php

declare(strict_types=1);

namespace App\Util\Core;

readonly class ClassNameExtractor
{
    /**
     * @param class-string $className
     */
    public static function getClassBaseName(string $className): string
    {
        $class = \explode('\\', $className);

        return \end($class);
    }
}
