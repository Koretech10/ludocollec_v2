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
    // Avoir un tableau avec null par défaut permet d'afficher du contenu statique dans le bloc `content`
    // quand il n'y a pas d'objets à itérer.
    public iterable $items = [null];
}
