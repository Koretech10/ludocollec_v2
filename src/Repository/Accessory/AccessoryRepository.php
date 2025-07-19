<?php

declare(strict_types=1);

namespace App\Repository\Accessory;

use App\Entity\Accessory\Accessory;
use App\Repository\BaseActionsTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AccessoryRepository extends ServiceEntityRepository
{
    /** @use BaseActionsTrait<Accessory> */
    use BaseActionsTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Accessory::class);
    }
}
