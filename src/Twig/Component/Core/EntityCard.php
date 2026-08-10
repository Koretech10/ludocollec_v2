<?php

declare(strict_types=1);

namespace App\Twig\Component\Core;

use App\Entity\ImageableEntity;
use App\Util\Core\ClassNameExtractor;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PostMount;

#[AsTwigComponent(name: 'entity-card')]
class EntityCard extends Card
{
    public ImageableEntity $entity;
    public int $truncateSize = 30;

    public function __construct(
        private readonly UrlGeneratorInterface $urlGenerator,
    ) {
    }

    #[PostMount]
    public function postMount(): void
    {
        $this->headerClass .= ' position-relative'; // Bloque le stretched-link sur le header uniquement
        $this->headerClass .= \sprintf(' bg-%s', \strtolower(ClassNameExtractor::getClassBaseName($this->entity::class)));
    }

    public function getShowPath(): string
    {
        return $this->urlGenerator->generate($this->entity->getShowRoute(), ['id' => $this->entity->getId()]);
    }
}
