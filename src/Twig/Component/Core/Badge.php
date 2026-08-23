<?php

declare(strict_types=1);

namespace App\Twig\Component\Core;

use App\Enum\Core\Type;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('badge')]
class Badge
{
    public Type $type = Type::SECONDARY;

    public function getClasses(): string
    {
        $classes = ['badge'];

        $classes[] = \sprintf('bg-%s', $this->type->value);

        return implode(' ', $classes);
    }
}
