<?php

declare(strict_types=1);

namespace App\Twig\Component\Core;

use App\Enum\Core\Type;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('button')]
class Button
{
    /** @var list<string> */
    private array $attributes = [];

    public Type $type = Type::SECONDARY;
    public ?string $href = null;
    public bool $outlined = false;
    public ?string $modalTarget = null;
    public ?string $additionalAttributes = null;
    public ?string $additionalClasses = null;
    public bool $submit = false;
    public bool $dropdownToggle = false;

    public function getClasses(): string
    {
        $classes = ['btn', $this->additionalClasses];

        if (true === $this->outlined) {
            $classes[] = \sprintf('btn-outline-%s', $this->type->value);
        } else {
            $classes[] = \sprintf('btn-%s', $this->type->value);
        }

        if ($this->dropdownToggle) {
            $classes[] = 'dropdown-toggle';
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

        if ($this->dropdownToggle) {
            $this->setupDropdown();
        }

        return \sprintf('%s %s', \implode(' ', $this->attributes), $this->additionalAttributes);
    }

    public function getButtonType(): string
    {
        return \sprintf(' type="%s" ', true === $this->submit ? 'submit' : 'button');
    }

    public function setupModal(): void
    {
        $this->attributes[] = 'data-bs-toggle="modal"';
        $this->attributes[] = \sprintf('data-bs-target="#%s"', $this->modalTarget);
    }

    public function setupDropdown(): void
    {
        $this->attributes[] = 'data-bs-toggle="dropdown"';
        $this->attributes[] = 'data-bs-popper-config=\'{"strategy":"fixed"}\'';
    }
}
