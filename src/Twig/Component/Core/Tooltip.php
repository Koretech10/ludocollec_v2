<?php

declare(strict_types=1);

namespace App\Twig\Component\Core;

use App\Enum\Core\Direction;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('tooltip')]
class Tooltip
{
    public string $title;
    public ?Direction $direction = null;
}
