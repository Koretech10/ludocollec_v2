<?php

declare(strict_types=1);

namespace App\Repository\Accessory;

use App\Entity\Accessory\Manufacturer;
use App\Repository\BaseActionsTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ManufacturerRepository extends ServiceEntityRepository
{
    /** @use BaseActionsTrait<Manufacturer> */
    use BaseActionsTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Manufacturer::class);
    }
}
