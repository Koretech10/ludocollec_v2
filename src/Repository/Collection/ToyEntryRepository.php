<?php

declare(strict_types=1);

namespace App\Repository\Collection;

use App\Entity\Collection\ToyEntry;
use App\Repository\BaseActionsTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ToyEntryRepository extends ServiceEntityRepository
{
    /** @use BaseActionsTrait<ToyEntry> */
    use BaseActionsTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ToyEntry::class);
    }
}
