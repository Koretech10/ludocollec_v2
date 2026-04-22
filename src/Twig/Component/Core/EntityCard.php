<?php

declare(strict_types=1);

namespace App\Twig\Component\Core;

use App\Entity\ImageableEntity;
use App\Util\Core\ClassNameExtractor;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PostMount;

#[AsTwigComponent(name: 'entity-card')]
class EntityCard extends Card
{
    public ImageableEntity $entity;

    #[PostMount]
    public function postMount(): void
    {
        $this->headerClass .= \sprintf(' bg-%s', \strtolower(ClassNameExtractor::getClassBaseName($this->entity::class)));
    }
}
