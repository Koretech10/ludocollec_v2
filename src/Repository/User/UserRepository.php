<?php

namespace App\Repository\User;

use App\Entity\User\User;
use App\Repository\BaseActionTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository
{
    /** @use BaseActionTrait<User> */
    use BaseActionTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }
}
