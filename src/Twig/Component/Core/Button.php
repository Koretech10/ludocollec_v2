<?php

declare(strict_types=1);

namespace App\Twig\Component\Core;

use App\Enum\Core\Type;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('button')]
class Button
{
    public Type $type = Type::PRIMARY;
    public ?string $href = null;
    public bool $outlined = false;
    public ?string $modalTarget = null;

    private array $attributes = [];

    public function getClasses(): string
    {
        $classes = ['btn'];

        if (true === $this->outlined) {
            $classes[] = \sprintf('btn-outline-%s', $this->type->value);
        } else {
            $classes[] = \sprintf('btn-%s', $this->type->value);
        }

        return \sprintf(' class="%s" ', implode(' ', $classes));
    }

    public function getTag(): string
    {
        return null !== $this->href ? 'a' : 'button';
    }

    public function getAttributes(): string
    {
        if (null !== $this->modalTarget) {
            $this->setupModal();
        }

        return \implode(' ', $this->attributes);
    }

    public function setupModal(): void
    {
        $this->attributes[] = 'data-toggle="modal"';
        $this->attributes[] = \sprintf('data-target="#%s"', $this->modalTarget);
    }
}
