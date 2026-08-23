<?php

declare(strict_types=1);

namespace App\Entity\Toy;

use App\Repository\Toy\ManufacturerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ManufacturerRepository::class, readOnly: true)]
#[ORM\Table(name: 'toy_manufacturers')]
class Manufacturer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(name: 'toy_manufacturer_name')]
    private string $name;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $isNew;

    public function __toString(): string
    {
        return $this->getName();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isNew(): bool
    {
        return $this->isNew;
    }
}
