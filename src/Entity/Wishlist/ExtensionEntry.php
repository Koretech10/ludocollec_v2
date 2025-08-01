<?php

declare(strict_types=1);

namespace App\Entity\Wishlist;

use App\Entity\Extension\Extension;
use App\Entity\User\User;
use App\Entity\UserList\UserListEntry;
use App\Enum\Collection\Medium;
use App\Enum\Collection\Region;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'extensions_wishlists')]
class ExtensionEntry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Extension::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Extension $extension;

    #[ORM\Column(name: 'extension_wishlist_comment', type: Types::TEXT, nullable: true)]
    private ?string $comment;

    /** @var ArrayCollection<UserListEntry> $userListEntries */
    #[ORM\OneToMany(targetEntity: UserListEntry::class, mappedBy: 'extensionWishlistEntry', cascade: ['remove'])]
    private Collection $userListEntries;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'extensionWishlistEntries')]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    #[ORM\Column(enumType: Region::class)]
    private Region $region;

    #[ORM\Column(name: 'extension_medium', enumType: Medium::class)]
    private Medium $medium;
}
