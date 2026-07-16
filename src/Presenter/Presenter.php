<?php

declare(strict_types=1);

namespace App\Presenter;

interface Presenter
{
    /**
     * @param array<string, mixed> $parameters
     *
     * @return array<string, mixed>
     */
    public function getParameters(array $parameters): array;
}
