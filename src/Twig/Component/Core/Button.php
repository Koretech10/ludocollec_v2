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
    public ?string $additionalAttributes = null;

    private array $attributes = [];

    public function getClasses(): string
    {
        $classes = ['btn'];

        if (true === $this->outlined) {
            $classes[] = \sprintf('btn-outline-%s', $this->type->value);
        } else {
            $classes[] = \sprintf('btn-%s', $this->type->value);
        }

        return \sprintf(' class="%s" ', \implode(' ', $classes));
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

        return \sprintf('%s %s', \implode(' ', $this->attributes), $this->additionalAttributes);
    }

    public function setupModal(): void
    {
        $this->attributes[] = 'data-bs-toggle="modal"';
        $this->attributes[] = \sprintf('data-bs-target="#%s"', $this->modalTarget);
    }
}
