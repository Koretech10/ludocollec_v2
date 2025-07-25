<?php

declare(strict_types=1);

namespace App\Entity\UserList;

use App\Entity\Collection as Collection;
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

    /**
     * ToDo.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\ExtensionsCollections", inversedBy="userListsContents")
     *
     * @ORM\JoinColumn(nullable=true)
     */
    private object $extensionCollection;

    /**
     * ToDo.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\ExtensionsWishlists", inversedBy="userListsContents")
     *
     * @ORM\JoinColumn(nullable=true)
     */
    private object $extensionWishlist;

    /**
     * ToDo.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\GamesCollections", inversedBy="userListsContents")
     *
     * @ORM\JoinColumn(nullable=true)
     */
    private object $gameCollection;

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

    /**
     * ToDo.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\ConsolesWishlists", inversedBy="userListsContents")
     *
     * @ORM\JoinColumn(nullable=true)
     */
    private object $consoleWishlist;

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

    /**
     * ToDo.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\ToysCollections", inversedBy="userListsContents")
     */
    private object $toyCollection;

    /**
     * ToDo.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\ToysWishlists", inversedBy="userListsContents")
     */
    private object $toyWishlist;
}
