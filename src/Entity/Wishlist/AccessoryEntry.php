<?php

declare(strict_types=1);

namespace App\Entity\Wishlist;

use App\Entity\Accessory\Accessory;
use App\Entity\User\User;
use App\Entity\UserList\UserListEntry;
use App\Enum\Collection\Region;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'accessories_wishlists')]
class AccessoryEntry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Accessory::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Accessory $accessory;

    #[ORM\Column(enumType: Region::class)]
    private Region $region;

    #[ORM\Column(name: 'accessory_wishlist_comment', type: Types::TEXT, nullable: true)]
    private ?string $comment;

    /** @var ArrayCollection<UserListEntry> $userListEntries */
    #[ORM\OneToMany(targetEntity: UserListEntry::class, mappedBy: 'accessoryWishlistEntry', cascade: ['remove'])]
    private Collection $userListEntries;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'accessoryWishlistEntries')]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;
}
