<?php

declare(strict_types=1);

namespace App\Entity\Accessory;

use App\Entity\Console\Console;
use App\Entity\Creatable;
use App\Entity\Lockable;
use App\Entity\Validatable;
use App\Enum\Accessory\Type;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'accessories')]
class Accessory
{
    use Lockable;
    use Creatable;
    use Validatable;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Console::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Console $console;

    #[ORM\ManyToOne(targetEntity: Manufacturer::class, inversedBy: 'accessories')]
    #[ORM\JoinColumn(name: 'accessory_manufacturer_id', nullable: false)]
    private Manufacturer $manufacturer;

    #[ORM\Column(name: 'accessory_type_id', enumType: Type::class)]
    private Type $accessoryType;

    #[ORM\Column(name: 'accessory_name')]
    private string $name;

    #[ORM\Column(name: 'accessory_release_date', type: Types::DATE_MUTABLE)]
    private \DateTime $releaseDate;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $isAccessoryNew;

    /**
     * ToDo
     * Cascade REMOVE.
     *
     * @ORM\OneToMany(targetEntity="App\Entity\AccessoriesCollections", mappedBy="accessory")
     */
    private object $accessoriesCollections;

    /**
     * ToDo
     * Cascade REMOVE.
     *
     * @ORM\OneToMany(targetEntity="App\Entity\AccessoriesWishlists", mappedBy="accessory")
     */
    private object $accessoriesWishlists;

    #[ORM\ManyToOne(targetEntity: Accessory::class, inversedBy: 'children')]
    #[ORM\JoinColumn(name: 'accessory_family_parent_id')]
    private Accessory $parent;

    /**
     * @var ArrayCollection<Accessory> $children
     */
    #[ORM\OneToMany(targetEntity: Accessory::class, mappedBy: 'parent')]
    private Collection $children;
}
