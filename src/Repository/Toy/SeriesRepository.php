<?php

declare(strict_types=1);

namespace App\Repository\Toy;

use App\Entity\Toy\Series;
use App\Repository\BaseActionsTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SeriesRepository extends ServiceEntityRepository
{
    /** @use BaseActionsTrait<Series> */
    use BaseActionsTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Series::class);
    }
}
