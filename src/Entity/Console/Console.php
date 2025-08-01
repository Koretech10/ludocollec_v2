<?php

declare(strict_types=1);

namespace App\Entity\Console;

use App\Entity\Creatable;
use App\Entity\Lockable;
use App\Entity\Validatable;
use App\Enum\Console\Type;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'consoles')]
class Console
{
    use Lockable;
    use Creatable;
    use Validatable;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Manufacturer::class, inversedBy: 'consoles')]
    #[ORM\JoinColumn(name: 'console_manufacturer_id', nullable: false)]
    private Manufacturer $manufacturer;

    #[ORM\Column(name: 'console_type_id', enumType: Type::class)]
    private Type $consoleType;

    #[ORM\Column(name: 'console_name')]
    private string $name;

    #[ORM\Column(name: 'console_release_date', type: Types::DATE_MUTABLE)]
    private \DateTime $releaseDate;

    #[ORM\Column(name: 'is_console_new', type: Types::BOOLEAN)]
    private bool $isNew;

    // Est-ce que cette plateforme possède une libraire de jeux interchangeables ou n'a-t-elle que des jeux intégrés ?
    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $areGamesSwitchable;

    #[ORM\ManyToOne(targetEntity: Console::class, inversedBy: 'children')]
    #[ORM\JoinColumn(name: 'console_family_parent_id')]
    private Console $parent;

    #[ORM\OneToMany(targetEntity: Console::class, mappedBy: 'parent')]
    private Collection $children;
}
