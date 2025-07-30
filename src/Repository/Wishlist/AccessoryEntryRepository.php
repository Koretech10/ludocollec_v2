<?php

declare(strict_types=1);

namespace App\Repository\Wishlist;

use App\Entity\Wishlist\AccessoryEntry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AccessoryEntryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccessoryEntry::class);
    }
}
