<?php

declare(strict_types=1);

namespace App\Entity\Console;

use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'console_manufacturers')]
class Manufacturer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(name: 'console_manufacturer_name')]
    private string $name;

    #[ORM\Column(name: 'is_console_manufacturer_new', type: Types::BOOLEAN)]
    private bool $isNew;

    /**
     * ToDo
     * Cascade REMOVE
     * @ORM\OneToMany(targetEntity="App\Entity\Consoles", mappedBy="consoleManufacturer")
     */
    private Collection $consoles;
}
