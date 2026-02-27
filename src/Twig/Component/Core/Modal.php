<?php

declare(strict_types=1);

namespace App\Twig\Component\Core;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('modal')]
class Modal
{
    public string $id;
}
