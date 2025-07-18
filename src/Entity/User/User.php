<?php

namespace App\Entity\User;

use App\Enum\User\DisplayListType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
#[ORM\UniqueConstraint(fields: ['username', 'email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    /** @var non-empty-string */
    #[ORM\Column]
    private string $username;

    #[ORM\Column]
    private string $email;

    #[ORM\Column]
    private string $password;

    /**
     * @var list<string> $roles
     */
    #[ORM\Column(type: 'json')]
    private array $roles = [];

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

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param non-empty-string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }


    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function isCollectionHidden(): bool
    {
        return $this->hideCollection;
    }

    public function setHideCollection(bool $hideCollection): void
    {
        $this->hideCollection = $hideCollection;
    }

    public function isWishlistHidden(): bool
    {
        return $this->hideWishlist;
    }

    public function setHideWishlist(bool $hideWishlist): void
    {
        $this->hideWishlist = $hideWishlist;
    }

    public function getUserIdentifier(): string
    {
        return $this->username;
    }

    /**
     * Ensure the session doesn't contain actual password hashes by CRC32C-hashing them, as supported since Symfony 7.3.
     */
    public function __serialize(): array
    {
        $data = (array) $this;
        $data["\0".self::class."\0password"] = hash('crc32c', $this->password);

        return $data;
    }

    #[\Deprecated]
    public function eraseCredentials(): void
    {
        // @deprecated, to be removed when upgrading to Symfony 8
    }
}
