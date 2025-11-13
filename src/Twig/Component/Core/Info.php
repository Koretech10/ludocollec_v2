<?php

declare(strict_types=1);

namespace App\Twig\Component\Core;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'info',
    template: 'component/core/info.html.twig',
)]
class Info
{
    public string $label;
}
