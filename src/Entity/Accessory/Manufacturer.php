<?php

declare(strict_types=1);

namespace App\Entity\Accessory;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'accessory_manufacturers')]
class Manufacturer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(name: 'accessory_manufacturer_name')]
    private string $name;

    #[ORM\Column(name: 'is_accessory_manufacturer_new', type: 'boolean')]
    private bool $isNew;

    /**
     * @var ArrayCollection<Accessory>
     */
    #[ORM\OneToMany(targetEntity: Accessory::class, mappedBy: 'manufacturer', cascade: ['remove'])]
    private Collection $accessories;
}
