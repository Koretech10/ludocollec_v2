<?php

declare(strict_types=1);

namespace App\Twig\Component\Core;

use App\Enum\Core\Icon as IconEnum;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'icon')]
class Icon
{
    public IconEnum $icon;
    public string $class = '';
}
