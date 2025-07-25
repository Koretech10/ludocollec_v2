<?php

declare(strict_types=1);

namespace App\Repository\Collection;

use App\Entity\Collection\ConsoleEntry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ConsoleEntryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConsoleEntry::class);
    }
}
