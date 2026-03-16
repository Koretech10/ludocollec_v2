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
    public string $classes = '';

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

    public function getModalId(): string
    {
        $class = explode('\\', $this->entity::class);
        $classBaseName = end($class);

        return \sprintf('%s%s', $classBaseName, $this->entity->getId());
    }
}
