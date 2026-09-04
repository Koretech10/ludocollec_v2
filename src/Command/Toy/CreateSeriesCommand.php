<?php

declare(strict_types=1);

namespace App\Command\Toy;

use App\Entity\Toy\Series;
use App\Enum\Toy\Brand;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Messenger\Attribute\AsMessage;
use Symfony\Component\Validator\Constraints\NotBlank;

#[AsMessage]
#[UniqueEntity(
    fields: ['name', 'brand'],
    message: 'Cette série existe déjà.',
    entityClass: Series::class,
)]
class CreateSeriesCommand
{
    #[NotBlank]
    public string $name;

    public Brand $brand;
}
