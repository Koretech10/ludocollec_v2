<?php

declare(strict_types=1);

namespace App\Repository\Collection;

use App\Entity\Collection\AccessoryEntry;
use App\Repository\BaseActionsTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AccessoryEntryRepository extends ServiceEntityRepository
{
    /** @use BaseActionsTrait<AccessoryEntry> */
    use BaseActionsTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccessoryEntry::class);
    }
}
