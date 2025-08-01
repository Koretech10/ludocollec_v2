<?php

declare(strict_types=1);

namespace App\Entity\Accessory;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'accessory_manufacturers')]
class Manufacturer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(name: 'accessory_manufacturer_name')]
    private string $name;

    #[ORM\Column(name: 'is_accessory_manufacturer_new', type: Types::BOOLEAN)]
    private bool $isNew;
}
