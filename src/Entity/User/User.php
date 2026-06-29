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
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'users')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    /**
     * @var non-empty-string
     */
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

    /**
     * Hache le hash du mot de passe pour éviter qu'il soit accessible dans le session storage.
     *
     * @see https://symfony.com/doc/current/security.html#understanding-how-users-are-refreshed-from-the-session
     */
    public function __serialize(): array
    {
        $data = (array) $this;
        $data[\sprintf("\0%s\0password", self::class)] = hash('crc32c', $this->password);

        return $data;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;

        return \array_unique($roles);
    }

    #[\Deprecated('to be removed when upgrading to Symfony 8')]
    public function eraseCredentials(): void
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->username;
    }

    public function getDisplayListType(): DisplayListType
    {
        return $this->displayListType;
    }

    public function setDisplayListType(DisplayListType $displayListType): void
    {
        $this->displayListType = $displayListType;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }
}
