<?php

declare(strict_types=1);

namespace App\Entity\Collection;

use App\Entity\Accessory\Accessory;
use App\Entity\User\User;
use App\Entity\UserList\UserListEntry;
use App\Enum\Collection\Preservation;
use App\Enum\Collection\Region;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'accessories_collections')]
class AccessoryEntry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Accessory::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Accessory $accessory;

    /** @var array<string> $condition */
    #[ORM\Column(name: 'accessory_condition', type: Types::JSON)]
    private array $condition;

    #[ORM\Column(enumType: Region::class)]
    private Region $region;

    #[ORM\Column(enumType: Preservation::class)]
    private Preservation $preservation;

    #[ORM\Column(name: 'accessory_buying_date', type: Types::DATE_MUTABLE)]
    private \DateTime $purchaseDate;

    #[ORM\Column(name: 'accessory_buying_price', type: Types::DECIMAL, precision: 11, scale: 2, nullable: true)]
    private ?string $purchasePrice;

    #[ORM\Column(name: 'accessory_collection_comment', type: Types::TEXT, nullable: true)]
    private ?string $comment;

    /** @var ArrayCollection<UserListEntry> $userListEntries */
    #[ORM\OneToMany(targetEntity: UserListEntry::class, mappedBy: 'accessoryCollectionEntry', cascade: ['remove'])]
    private Collection $userListEntries;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'accessoryCollectionEntries')]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    #[ORM\Column(name: 'accessory_out_date', type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $exitDate;
}
