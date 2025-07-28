<?php

declare(strict_types=1);

namespace App\Entity\Collection;

use App\Entity\Toy\Toy;
use App\Entity\User\User;
use App\Entity\UserList\UserListEntry;
use App\Enum\Collection\Preservation;
use App\Enum\Collection\Region;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'toys_collections')]
class ToyEntry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Toy::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Toy $toy;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'toyCollectionEntries')]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    #[ORM\Column(enumType: Region::class)]
    private Region $region;

    #[ORM\Column(enumType: Preservation::class)]
    private Preservation $preservation;

    /** @var array<string> $condition */
    #[ORM\Column(name: 'toy_condition', type: Types::JSON)]
    private array $condition;

    #[ORM\Column(name: 'toy_buying_date', type: Types::DATE_MUTABLE)]
    private \DateTime $purchaseDate;

    #[ORM\Column(name: 'toy_buying_price', type: Types::DECIMAL, precision: 11, scale: 2, nullable: true)]
    private ?string $purchasePrice;

    #[ORM\Column(name: 'toy_collection_comment', nullable: true)]
    private ?string $comment;

    /** @var ArrayCollection<UserListEntry> $userListEntries */
    #[ORM\OneToMany(targetEntity: UserListEntry::class, mappedBy: 'toyCollectionEntry', cascade: ['remove'])]
    private Collection $userListEntries;

    #[ORM\Column(name: 'toy_out_date', type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $exitDate;
}
