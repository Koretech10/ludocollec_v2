<?php

declare(strict_types=1);

namespace App\Repository\Wishlist;

use App\Entity\Wishlist\ToyEntry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ToyEntryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ToyEntry::class);
    }
}
