<?php

declare(strict_types=1);

namespace App\Entity\Toy;

use App\Enum\Toy\Brand;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'toy_series')]
class Series
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(name: 'toy_brand_id', enumType: Brand::class)]
    private Brand $toyBrand;

    #[ORM\Column(name: 'toy_series_name')]
    private string $name;

    #[ORM\Column]
    private bool $isNew;
}
