<?php

declare(strict_types=1);

namespace App\Entity\Collection;

use App\Entity\Game\Game;
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
#[ORM\Table(name: 'games_collections')]
class GameEntry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Game::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Game $game;

    #[ORM\Column(name: 'completion_progress', enumType: Completion::class)]
    private Completion $completion;

    #[ORM\Column(enumType: Region::class)]
    private Region $region;

    #[ORM\Column(enumType: Preservation::class)]
    private Preservation $preservation;

    /** @var array<string> $condition */
    #[ORM\Column(name: 'game_condition', type: Types::JSON)]
    private array $condition;

    #[ORM\Column(name: 'game_buying_date', type: Types::DATE_MUTABLE)]
    private \DateTime $purchaseDate;

    #[ORM\Column(name: 'game_buying_price', type: Types::DECIMAL, precision: 11, scale: 2, nullable: true)]
    private ?string $purchasePrice;

    #[ORM\Column(name: 'game_collection_comment', type: Types::TEXT, nullable: true)]
    private ?string $comment;

    /** @var ArrayCollection<UserListEntry> $userListEntries */
    #[ORM\OneToMany(targetEntity: UserListEntry::class, mappedBy: 'gameCollectionEntry', cascade: ['remove'])]
    private Collection $userListEntries;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'gameCollectionEntries')]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    #[ORM\Column(name: 'game_medium', enumType: Medium::class, options: ['default' => Medium::UNSPECIFIED])]
    private Medium $medium = Medium::UNSPECIFIED;

    #[ORM\Column(name: 'game_out_date', type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $exitDate;
}
