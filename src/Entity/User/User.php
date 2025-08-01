<?php

declare(strict_types=1);

namespace App\Entity\User;

use App\Entity\Collection as CollectionEntries;
use App\Entity\UserList\UserList;
use App\Entity\Wishlist as WishlistEntries;
use App\Enum\User\DisplayListType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'users')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(unique: true)]
    private string $username;

    #[ORM\Column(unique: true)]
    private string $email;

    #[ORM\Column]
    private string $password;

    /** @var list<string> $roles */
    #[ORM\Column(type: Types::JSON)]
    private array $roles = [];

    /** @var ArrayCollection<CollectionEntries\AccessoryEntry> */
    #[ORM\OneToMany(targetEntity: CollectionEntries\AccessoryEntry::class, mappedBy: 'user', cascade: ['remove'])]
    private Collection $accessoryCollectionEntries;

    /** @var ArrayCollection<WishlistEntries\AccessoryEntry> $accessoryWishlistEntries */
    #[ORM\OneToMany(targetEntity: WishlistEntries\AccessoryEntry::class, mappedBy: 'user', cascade: ['remove'])]
    private Collection $accessoryWishlistEntries;

    /** @var ArrayCollection<CollectionEntries\ConsoleEntry> $consoleCollectionEntries */
    #[ORM\OneToMany(targetEntity: CollectionEntries\ConsoleEntry::class, mappedBy: 'user', cascade: ['remove'])]
    private Collection $consoleCollectionEntries;

    /** @var ArrayCollection<WishlistEntries\ConsoleEntry> $consoleWishlistEntries */
    #[ORM\OneToMany(targetEntity: WishlistEntries\ConsoleEntry::class, mappedBy: 'user', cascade: ['remove'])]
    private Collection $consoleWishlistEntries;

    /** @var ArrayCollection<CollectionEntries\GameEntry> $gameCollectionEntries */
    #[ORM\OneToMany(targetEntity: CollectionEntries\GameEntry::class, mappedBy: 'user', cascade: ['remove'])]
    private Collection $gameCollectionEntries;

    /** @var ArrayCollection<WishlistEntries\GameEntry> $gameWishlistEntries */
    #[ORM\OneToMany(targetEntity: WishlistEntries\GameEntry::class, mappedBy: 'user', cascade: ['remove'])]
    private Collection $gameWishlistEntries;

    /** @var ArrayCollection<CollectionEntries\ExtensionEntry> $extensionCollectionEntries */
    #[ORM\OneToMany(targetEntity: CollectionEntries\ExtensionEntry::class, mappedBy: 'user', cascade: ['remove'])]
    private Collection $extensionCollectionEntries;

    /** @var ArrayCollection<WishlistEntries\ExtensionEntry> $extensionWishlistEntries */
    #[ORM\OneToMany(targetEntity: WishlistEntries\ExtensionEntry::class, mappedBy: 'user', cascade: ['remove'])]
    private Collection $extensionWishlistEntries;

    /** @var ArrayCollection<CollectionEntries\ToyEntry> $toyCollectionEntries */
    #[ORM\OneToMany(targetEntity: CollectionEntries\ToyEntry::class, mappedBy: 'user', cascade: ['remove'])]
    private Collection $toyCollectionEntries;

    /** @var ArrayCollection<WishlistEntries\ToyEntry> $toyWishlistEntries */
    #[ORM\OneToMany(targetEntity: WishlistEntries\ToyEntry::class, mappedBy: 'user', cascade: ['remove'])]
    private Collection $toyWishlistEntries;

    /** @var ArrayCollection<UserList> $userLists */
    #[ORM\OneToMany(targetEntity: UserList::class, mappedBy: 'user', cascade: ['remove'])]
    private Collection $userLists;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $isActive;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $hideCollection;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $hideWishlist;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $disableAds;

    #[ORM\Column(enumType: DisplayListType::class, options: ['default' => DisplayListType::CARD_GRID])]
    private DisplayListType $displayListType = DisplayListType::CARD_GRID;
}
