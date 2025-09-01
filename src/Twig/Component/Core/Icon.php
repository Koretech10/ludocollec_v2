<?php

declare(strict_types=1);

namespace App\Twig\Component\Core;

use App\Enum\Core\Icon as IconEnum;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'Icon',
    template: 'component/core/icon.html.twig',
)]
class Icon
{
    public string $name;
    public string $class = '';

    public function getIcon(): string
    {
        return IconEnum::fromName($this->name)->value;
    }
}
