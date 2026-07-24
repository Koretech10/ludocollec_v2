<?php

declare(strict_types=1);

namespace App\Twig\Component\Core;

use App\Enum\Core\Direction;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('truncated-text')]
class TruncatedText
{
    public string $text;
    public int $size = 80;
    public Direction $direction = Direction::bottom;
}
