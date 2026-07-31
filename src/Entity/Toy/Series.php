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
    private Brand $brand;

    #[ORM\Column(name: 'toy_series_name')]
    private string $name;

    #[ORM\Column]
    private bool $isNew;

    public function __toString(): string
    {
        return $this->getNameAndBrand();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getBrand(): Brand
    {
        return $this->brand;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isNew(): bool
    {
        return $this->isNew;
    }

    public function getNameAndBrand(): string
    {
        return \sprintf('%s (%s)', $this->getName(), $this->brand->label());
    }
}
