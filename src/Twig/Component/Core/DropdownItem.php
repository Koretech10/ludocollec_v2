<?php

declare(strict_types=1);

namespace App\Twig\Component\Core;

use App\Enum\Core\Type;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('dropdown:item')]
class DropdownItem
{
    public string $href;

    public Type $type = Type::SECONDARY;
    public string $class = '';
    public bool $active = false;

    public function getClasses(): string
    {
        $classes = ['dropdown-item'];

        $classes[] = \sprintf('dropdown-item-%s', $this->type->value);

        if ($this->active) {
            $classes[] = 'active';
        }

        return \sprintf('%s %s', \implode(' ', $classes), $this->class);
    }
}
