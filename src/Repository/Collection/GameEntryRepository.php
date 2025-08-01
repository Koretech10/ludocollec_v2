<?php

declare(strict_types=1);

namespace App\Repository\Collection;

use App\Entity\Collection\GameEntry;
use App\Repository\BaseActionsTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class GameEntryRepository extends ServiceEntityRepository
{
    /** @use BaseActionsTrait<GameEntry> */
    use BaseActionsTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameEntry::class);
    }
}
