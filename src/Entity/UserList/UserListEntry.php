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

    /**
     * ToDo.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\ExtensionsWishlists", inversedBy="userListsContents")
     *
     * @ORM\JoinColumn(nullable=true)
     */
    private object $extensionWishlist;

    #[ORM\ManyToOne(targetEntity: Collection\GameEntry::class, inversedBy: 'userListEntries')]
    #[ORM\JoinColumn(name: 'game_collection_id')]
    private ?Collection\GameEntry $gameCollectionEntry;

    /**
     * ToDo.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\GamesWishlists", inversedBy="userListsContents")
     *
     * @ORM\JoinColumn(nullable=true)
     */
    private object $gameWishlist;

    #[ORM\ManyToOne(targetEntity: Collection\ConsoleEntry::class, inversedBy: 'userListEntries')]
    #[ORM\JoinColumn(name: 'console_collection_id')]
    private ?Collection\ConsoleEntry $consoleCollectionEntry;

    #[ORM\ManyToOne(targetEntity: Wishlist\ConsoleEntry::class, inversedBy: 'userListEntries')]
    #[ORM\JoinColumn(name: 'console_wishlist_id')]
    private ?Wishlist\ConsoleEntry $consoleWishlistEntry;

    #[ORM\ManyToOne(targetEntity: Collection\AccessoryEntry::class, inversedBy: 'userListEntries')]
    #[ORM\JoinColumn(name: 'accessory_collection_id')]
    private ?Collection\AccessoryEntry $accessoryCollectionEntry;

    /**
     * ToDo.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\AccessoriesWishlists", inversedBy="userListsContents")
     *
     * @ORM\JoinColumn(nullable=true)
     */
    private object $accessoryWishlist;

    #[ORM\ManyToOne(targetEntity: Collection\ToyEntry::class, inversedBy: 'userListEntries')]
    #[ORM\JoinColumn(name: 'toy_collection_id')]
    private ?Collection\ToyEntry $toyCollectionEntry;

    /**
     * ToDo.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\ToysWishlists", inversedBy="userListsContents")
     */
    private object $toyWishlist;
}
