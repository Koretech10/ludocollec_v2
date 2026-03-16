<?php

declare(strict_types=1);

namespace App\Entity;

interface ImageableEntity
{
    public function getId(): int;

    public function title(): string;
}
