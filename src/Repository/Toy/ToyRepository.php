<?php

declare(strict_types=1);

namespace App\Repository\Toy;

use App\Entity\Toy\Toy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ToyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Toy::class);
    }
}
