<?php

declare(strict_types=1);

namespace App\Entity\Collection;

use App\Entity\Extension\Extension;
use App\Entity\User\User;
use App\Entity\UserList\UserListEntry;
use App\Enum\Collection\Completion;
use App\Enum\Collection\Medium;
use App\Enum\Collection\Preservation;
use App\Enum\Collection\Region;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'extensions_collections')]
class ExtensionEntry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Extension::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Extension $extension;

    #[ORM\Column(name: 'completion_progress', enumType: Completion::class)]
    private Completion $completion;

    /** @var array<string> $condition */
    #[ORM\Column(name: 'extension_condition', type: Types::JSON)]
    private array $condition;

    #[ORM\Column(name: 'extension_buying_date', type: Types::DATE_MUTABLE)]
    private \DateTime $purchaseDate;

    #[ORM\Column(name: 'extension_buying_price', type: Types::DECIMAL, precision: 11, scale: 2, nullable: true)]
    private ?string $purchasePrice;

    #[ORM\Column(name: 'extension_collection_comment', type: Types::TEXT, nullable: true)]
    private ?string $comment;

    /** @var ArrayCollection<UserListEntry> $userListEntries */
    #[ORM\OneToMany(targetEntity: UserListEntry::class, mappedBy: 'extensionCollectionEntry', cascade: ['remove'])]
    private Collection $userListEntries;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'extensionCollectionEntries')]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    #[ORM\Column(name: 'extension_out_date', type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTime $exitDate;

    #[ORM\Column(enumType: Region::class)]
    private Region $region;

    #[ORM\Column(enumType: Preservation::class)]
    private Preservation $preservation;

    #[ORM\Column(name: 'extension_medium', enumType: Medium::class)]
    private Medium $medium;
}
