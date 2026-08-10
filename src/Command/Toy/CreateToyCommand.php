<?php

declare(strict_types=1);

namespace App\Command\Toy;

use App\Entity\Toy\Manufacturer;
use App\Entity\Toy\Series;
use App\Entity\Toy\Toy;
use App\Entity\User\User;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Messenger\Attribute\AsMessage;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

#[AsMessage]
#[UniqueEntity(
    fields: ['name', 'manufacturer', 'series', 'releaseDate'],
    message: 'Ce jouet vidéo existe déjà.',
    entityClass: Toy::class,
)]
class CreateToyCommand
{
    #[NotBlank]
    public string $name;

    #[NotNull]
    public Series $series;

    #[NotNull]
    public Manufacturer $manufacturer;

    #[NotNull]
    public \DateTime $releaseDate;

    #[Image(maxSize: '2M', maxSizeMessage: 'L’image ne peut pas faire plus de 2 Mo.')]
    public ?UploadedFile $image = null;

    public function __construct(public readonly User $author)
    {
    }
}
