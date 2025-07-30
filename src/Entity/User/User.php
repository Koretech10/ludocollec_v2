<?php

declare(strict_types=1);

namespace App\Entity\User;

use App\Entity\Collection as CollectionEntries;
use App\Entity\Wishlist as WishlistEntries;
use App\Entity\UserList\UserList;
use App\Enum\User\DisplayListType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'users')]
#[UniqueEntity(fields: 'email')]
#[UniqueEntity(fields: 'username')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column]
    private string $username;

    #[ORM\Column]
    private string $email;

    #[ORM\Column]
    private string $password;

    /** @var list<string> $roles */
    #[ORM\Column(type: 'json')]
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

    /**
     * ToDo Relation OneToMany
     * TargetEntity ExtensionWishlist
     * Cascade DELETE
     * InversedBy user.
     */
    private Collection $extensionWishlists;

    /** @var ArrayCollection<CollectionEntries\ToyEntry> $toyCollectionEntries */
    #[ORM\OneToMany(targetEntity: CollectionEntries\ToyEntry::class, mappedBy: 'user', cascade: ['remove'])]
    private Collection $toyCollectionEntries;

    /**
     * ToDo Relation OneToMany
     * TargetEntity ToyWishlist
     * Cascade DELETE
     * InversedBy user.
     */
    private Collection $toyWishlists;

    #[ORM\OneToMany(targetEntity: UserList::class, mappedBy: 'user', cascade: ['remove'])]
    private Collection $userLists;

    #[ORM\Column(type: 'boolean')]
    private bool $isActive = false;

    #[ORM\Column(type: 'boolean')]
    private bool $hideCollection = false;

    #[ORM\Column(type: 'boolean')]
    private bool $hideWishlist = false;

    #[ORM\Column(type: 'boolean')]
    private bool $disableAds = false;

    #[ORM\Column(enumType: DisplayListType::class)]
    private DisplayListType $displayListType = DisplayListType::CARD_GRID;
}
