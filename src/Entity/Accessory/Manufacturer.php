<?php

declare(strict_types=1);

namespace App\Entity\Accessory;

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
     * ToDo
     * Cascade REMOVE
     * @ORM\OneToMany(targetEntity="App\Entity\Accessories", mappedBy="accessoryManufacturer")
     */
    private object $accessories;
}
