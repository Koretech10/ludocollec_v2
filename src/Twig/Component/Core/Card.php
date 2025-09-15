<?php

declare(strict_types=1);

namespace App\Twig\Component\Core;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'card',
    template: 'component/core/card.html.twig',
)]
class Card
{
    public string $cardClass = '';
    public string $headerClass = '';
    public string $bodyClass = '';
    public string $footerClass = '';
}
