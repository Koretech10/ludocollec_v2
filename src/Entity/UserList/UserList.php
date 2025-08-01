<?php

declare(strict_types=1);

namespace App\Entity\UserList;

use App\Entity\User\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'user_lists')]
class UserList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(name: 'user_list_name')]
    private string $name;

    #[ORM\Column(name: 'user_list_description')]
    private string $description;

    #[ORM\Column(name: 'user_list_color', length: 7)]
    private string $color;

    /** @var ArrayCollection<UserListEntry> $userListEntries */
    #[ORM\OneToMany(targetEntity: UserListEntry::class, mappedBy: 'userList', cascade: ['remove'])]
    private Collection $userListEntries;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'userLists')]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $isPrivate;

    #[ORM\Column(name: 'numbered_user_list', type: Types::BOOLEAN)]
    private bool $isNumbered;
}
