<?php

declare(strict_types=1);

namespace App\Twig\Component\Core;

use App\Entity\ImageableEntity;
use App\Exception\Core\EntityNotManagedException;
use App\Util\Core\ImageManager;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PostMount;

#[AsTwigComponent('entity-image')]
class EntityImage
{
    private string $imagePath;

    public ImageableEntity $entity;

    public function __construct(
        private readonly ImageManager $imageManager,
    ) {
    }

    /**
     * @throws EntityNotManagedException
     */
    #[PostMount]
    public function postMount(): void
    {
        $this->imagePath = $this->imageManager->getImagePath($this->entity);
    }

    public function getImagePath(): string
    {
        return $this->imagePath;
    }
}
