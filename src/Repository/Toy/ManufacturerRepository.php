<?php

declare(strict_types=1);

namespace App\Repository\Toy;

use App\Entity\Toy\Manufacturer;
use App\Repository\BaseActionsTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Manufacturer|null findOneById(string|int $id)
 */
class ManufacturerRepository extends ServiceEntityRepository
{
    /** @use BaseActionsTrait<Manufacturer> */
    use BaseActionsTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Manufacturer::class);
    }

    public function findAllQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('manufacturer')
            ->orderBy('manufacturer.name', 'ASC')
        ;
    }
}
