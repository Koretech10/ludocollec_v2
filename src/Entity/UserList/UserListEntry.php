<?php

declare(strict_types=1);

namespace App\Entity\UserList;

use App\Entity\Collection;
use App\Entity\Wishlist;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'user_lists_content')]
class UserListEntry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: UserList::class, inversedBy: 'userListEntries')]
    #[ORM\JoinColumn(nullable: false)]
    private UserList $userList;

    #[ORM\Column(name: 'user_list_content_comment', type: 'text', nullable: true)]
    private ?string $comment;

    #[ORM\Column(type: 'integer')]
    private int $position;

    #[ORM\ManyToOne(targetEntity: Collection\ExtensionEntry::class, inversedBy: 'userListEntries')]
    #[ORM\JoinColumn(name: 'extension_collection_id')]
    private ?Collection\ExtensionEntry $extensionCollectionEntry;

    #[ORM\ManyToOne(targetEntity: Wishlist\ExtensionEntry::class, inversedBy: 'userListEntries')]
    #[ORM\JoinColumn(name: 'extension_wishlist_id')]
    private ?Wishlist\ExtensionEntry $extensionWishlistEntry;

    #[ORM\ManyToOne(targetEntity: Collection\GameEntry::class, inversedBy: 'userListEntries')]
    #[ORM\JoinColumn(name: 'game_collection_id')]
    private ?Collection\GameEntry $gameCollectionEntry;

    #[ORM\ManyToOne(targetEntity: Wishlist\GameEntry::class, inversedBy: 'userListEntries')]
    #[ORM\JoinColumn(name: 'game_wishlist_id')]
    private ?Wishlist\GameEntry $gameWishlistEntry;

    #[ORM\ManyToOne(targetEntity: Collection\ConsoleEntry::class, inversedBy: 'userListEntries')]
    #[ORM\JoinColumn(name: 'console_collection_id')]
    private ?Collection\ConsoleEntry $consoleCollectionEntry;

    #[ORM\ManyToOne(targetEntity: Wishlist\ConsoleEntry::class, inversedBy: 'userListEntries')]
    #[ORM\JoinColumn(name: 'console_wishlist_id')]
    private ?Wishlist\ConsoleEntry $consoleWishlistEntry;

    #[ORM\ManyToOne(targetEntity: Collection\AccessoryEntry::class, inversedBy: 'userListEntries')]
    #[ORM\JoinColumn(name: 'accessory_collection_id')]
    private ?Collection\AccessoryEntry $accessoryCollectionEntry;

    #[ORM\ManyToOne(targetEntity: Wishlist\AccessoryEntry::class, inversedBy: 'userListEntries')]
    #[ORM\JoinColumn(name: 'accessory_wishlist_id')]
    private ?Wishlist\AccessoryEntry $accessoryWishlistEntry;

    #[ORM\ManyToOne(targetEntity: Collection\ToyEntry::class, inversedBy: 'userListEntries')]
    #[ORM\JoinColumn(name: 'toy_collection_id')]
    private ?Collection\ToyEntry $toyCollectionEntry;

    #[ORM\ManyToOne(targetEntity: Wishlist\ToyEntry::class, inversedBy: 'userListEntries')]
    #[ORM\JoinColumn(name: 'toy_wishlist_id')]
    private ?Wishlist\ToyEntry $toyWishlistEntry;
}
