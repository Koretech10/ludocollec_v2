<?php

declare(strict_types=1);

namespace App\Twig\Component\Core;

use App\Enum\Icon\Icon as IconEnum;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'Icon',
    template: 'component/core/icon.html.twig',
)]
class Icon
{
    public string $iconName;
    public string $classes = '';

    public function getIcon(): string
    {
        return IconEnum::fromName($this->iconName)->value;
    }
}
