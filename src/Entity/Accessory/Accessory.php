<?php

declare(strict_types=1);

namespace App\Entity\Accessory;

use App\Entity\User\User;
use App\Enum\Accessory\Type;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'accessories')]
class Accessory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    /**
     * ToDo.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Consoles", inversedBy="accessories")
     *
     * @ORM\JoinColumn(nullable=false)
     */
    private object $console;

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

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn]
    private ?User $locker;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTime $lockTimestamp;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn]
    private ?User $createdBy;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTime $creationDate;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn]
    private ?User $validatedBy;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTime $validationDate;

    #[ORM\ManyToOne(targetEntity: Accessory::class, inversedBy: 'children')]
    #[ORM\JoinColumn(name: 'accessory_family_parent_id')]
    private Accessory $parent;

    /**
     * @var ArrayCollection<Accessory> $children
     */
    #[ORM\OneToMany(targetEntity: Accessory::class, mappedBy: 'parent')]
    private Collection $children;
}
