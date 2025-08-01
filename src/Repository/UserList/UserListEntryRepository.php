<?php

declare(strict_types=1);

namespace App\Repository\UserList;

use App\Entity\UserList\UserListEntry;
use App\Repository\BaseActionsTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserListEntryRepository extends ServiceEntityRepository
{
    /** @use BaseActionsTrait<UserListEntry> */
    use BaseActionsTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserListEntry::class);
    }
}
