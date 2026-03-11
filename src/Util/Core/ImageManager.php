<?php

declare(strict_types=1);

namespace App\Util\Core;

use App\Entity\ImageableEntity;
use App\Enum\Core\EntityToImageDir;
use App\Exception\Core\EntityNotManagedException;
use Symfony\Component\Filesystem\Filesystem;

readonly class ImageManager
{
    private const string IMAGE_ROOT = 'images';
    private const string APP_DIR = 'app';
    private const string DEFAULT_IMAGE_NAME = 'none';

    private Filesystem $filesystem;
    private string $defaultImagePath;

    public function __construct()
    {
        $this->filesystem = new Filesystem();
        $this->defaultImagePath = \sprintf('%s/%s/%s.jpg', self::IMAGE_ROOT, self::APP_DIR, self::DEFAULT_IMAGE_NAME);
    }

    /**
     * @throws EntityNotManagedException
     */
    public function getImagePath(ImageableEntity $entity): string
    {
        $entityImageDir = EntityToImageDir::fromEntityClass($entity::class);
        $imagePath = \sprintf('%s/%s/%s.jpg', self::IMAGE_ROOT, $entityImageDir->value, $entity->getId());

        if ($this->filesystem->exists($imagePath)) {
            return \sprintf('/%s', $imagePath);
        }

        return \sprintf('/%s', $this->defaultImagePath);
    }
}
