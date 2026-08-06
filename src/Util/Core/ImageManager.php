<?php

declare(strict_types=1);

namespace App\Util\Core;

use App\Entity\ImageableEntity;
use App\Enum\Core\EntityToImageDir;
use App\Exception\Core\EntityNotManagedException;
use App\Exception\Core\InvalidMimeTypeException;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Imagine\Image\ManipulatorInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
        $imagePath = $this->getEntityImageDirPath($entity);

        if ($this->filesystem->exists($imagePath)) {
            return \sprintf('/%s', $imagePath);
        }

        return \sprintf('/%s', $this->defaultImagePath);
    }

    /**
     * @throws InvalidMimeTypeException
     * @throws EntityNotManagedException
     */
    public function processUploadedFile(UploadedFile $uploadedFile, ImageableEntity $entity): void
    {
        $mimeType = $uploadedFile->getMimeType();

        if (null === $mimeType || !\str_starts_with($mimeType, 'image/')) {
            throw InvalidMimeTypeException::expectsImage($mimeType ?? 'NULL');
        }

        $imagine = new Imagine();

        $image = $imagine->open($uploadedFile->getPathname());

        $resizedImage = $this->resizeImage($image);

        $resizedImage->save($this->getEntityImageDirPath($entity), [
            'format' => 'jpeg',
            'jpeg_quality' => 100,
        ]);
    }

    /**
     * @throws EntityNotManagedException
     */
    private function getEntityImageDirPath(ImageableEntity $entity): string
    {
        $entityImageDir = EntityToImageDir::fromEntityClass($entity::class);

        return \sprintf('%s/%s/%s.jpg', self::IMAGE_ROOT, $entityImageDir->value, $entity->getId());
    }

    private function resizeImage(ImageInterface $image, int $maxLength = 1080): ManipulatorInterface
    {
        $maxDimensions = new Box($maxLength, $maxLength);

        // THUMBNAIL_INSET va adapter l'image aux dimensions maximales définies.
        return $image->thumbnail($maxDimensions, ManipulatorInterface::THUMBNAIL_INSET);
    }
}
