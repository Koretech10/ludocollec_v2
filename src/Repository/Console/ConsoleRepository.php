<?php

declare(strict_types=1);

namespace App\Repository\Console;

use App\Entity\Console\Console;
use App\Repository\BaseActionsTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ConsoleRepository extends ServiceEntityRepository
{
    /** @use BaseActionsTrait<Console> */
    use BaseActionsTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Console::class);
    }
}
