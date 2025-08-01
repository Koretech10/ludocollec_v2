<?php

declare(strict_types=1);

namespace App\Repository\Toy;

use App\Entity\Toy\Toy;
use App\Repository\BaseActionsTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ToyRepository extends ServiceEntityRepository
{
    /** @use BaseActionsTrait<Toy> */
    use BaseActionsTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Toy::class);
    }
}
