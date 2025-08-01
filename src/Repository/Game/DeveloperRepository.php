<?php

declare(strict_types=1);

namespace App\Repository\Game;

use App\Entity\Game\Developer;
use App\Repository\BaseActionsTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DeveloperRepository extends ServiceEntityRepository
{
    /** @use BaseActionsTrait<Developer> */
    use BaseActionsTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Developer::class);
    }
}
