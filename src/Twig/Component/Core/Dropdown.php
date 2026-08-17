<?php

declare(strict_types=1);

namespace App\Twig\Component\Core;

use App\Enum\Core\Type;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('dropdown')]
class Dropdown
{
    public Type $type = Type::SECONDARY;
    public bool $outlined = false;
    public ?iterable $items = null;
}
