<?php

declare(strict_types=1);

namespace App\Twig\Component\Core;

use App\Enum\Core\Type;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PostMount;

#[AsTwigComponent('toast')]
class Toast
{
    public ?Type $type = null;
    public ?string $typeValue = null;

    #[PostMount]
    public function postMount(): void
    {
        if (null === $this->type) {
            if (null === $this->typeValue) {
                throw new \InvalidArgumentException('$typeValue ne peut pas être NULL si $type est NULL.');
            }

            $this->type = Type::from($this->typeValue);
        }
    }
}
