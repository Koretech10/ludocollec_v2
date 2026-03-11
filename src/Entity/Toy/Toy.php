<?php

declare(strict_types=1);

namespace App\Entity\Toy;

use App\Entity\Creatable;
use App\Entity\ImageableEntity;
use App\Entity\Lockable;
use App\Entity\Validatable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'toys')]
class Toy implements ImageableEntity
{
    use Lockable;
    use Creatable;
    use Validatable;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Manufacturer::class)]
    #[ORM\JoinColumn(name: 'toy_manufacturer_id', nullable: false)]
    private Manufacturer $manufacturer;

    #[ORM\ManyToOne(targetEntity: Series::class)]
    #[ORM\JoinColumn(name: 'toy_series_id', nullable: false)]
    private Series $series;

    #[ORM\Column(name: 'toy_name')]
    private string $name;

    #[ORM\Column(name: 'toy_release_date', type: Types::DATE_MUTABLE)]
    private \DateTime $releaseDate;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $isNew;

    public function getId(): int
    {
        return $this->id;
    }

    public function getManufacturer(): Manufacturer
    {
        return $this->manufacturer;
    }

    public function getSeries(): Series
    {
        return $this->series;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getReleaseDate(): \DateTime
    {
        return $this->releaseDate;
    }

    public function isNew(): bool
    {
        return $this->isNew;
    }
}
