<?php

declare(strict_types=1);

namespace App\Entity\User;

use App\Entity\UserList\UserList;
use App\Enum\User\DisplayListType;
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

    /**
     * ToDo Relation OneToMany
     * TargetEntity AccessoryCollection
     * Cascade DELETE
     * InversedBy user
     */
    private Collection $accessoryCollections;

    /**
     * ToDo Relation OneToMany
     * TargetEntity AccessoryWishlist
     * Cascade DELETE
     * InversedBy user
     */
    private Collection $accessoryWishlists;

    /**
     * ToDo Relation OneToMany
     * TargetEntity ConsoleCollection
     * Cascade DELETE
     * InversedBy user
     */
    private Collection $consoleCollections;

    /**
     * ToDo Relation OneToMany
     * TargetEntity ConsoleWishlist
     * Cascade DELETE
     * InversedBy user
     */
    private Collection $consoleWishlists;

    /**
     * ToDo Relation OneToMany
     * TargetEntity GameCollection
     * Cascade DELETE
     * InversedBy user
     */
    private Collection $gameCollections;

    /**
     * ToDo Relation OneToMany
     * TargetEntity GameWishlist
     * Cascade DELETE
     * InversedBy user
     */
    private Collection $gameWishlists;

    /**
     * ToDo Relation OneToMany
     * TargetEntity ExtensionCollection
     * Cascade DELETE
     * InversedBy user
     */
    private Collection $extensionCollections;

    /**
     * ToDo Relation OneToMany
     * TargetEntity ExtensionWishlist
     * Cascade DELETE
     * InversedBy user
     */
    private Collection $extensionWishlists;

    /**
     * ToDo Relation OneToMany
     * TargetEntity ToyCollection
     * Cascade DELETE
     * InversedBy user
     */
    private Collection $toyCollections;

    /**
     * ToDo Relation OneToMany
     * TargetEntity ToyWishlist
     * Cascade DELETE
     * InversedBy user
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
