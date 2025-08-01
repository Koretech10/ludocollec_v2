<?php

declare(strict_types=1);

namespace App\Repository\UserList;

use App\Entity\UserList\UserList;
use App\Repository\BaseActionsTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserListRepository extends ServiceEntityRepository
{
    /** @use BaseActionsTrait<UserList> */
    use BaseActionsTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserList::class);
    }
}
