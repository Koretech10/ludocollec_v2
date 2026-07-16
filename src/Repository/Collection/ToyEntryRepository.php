<?php

declare(strict_types=1);

namespace App\Repository\Collection;

use App\Entity\Collection\ToyEntry;
use App\Entity\Toy\Toy;
use App\Entity\User\User;
use App\Repository\BaseActionsTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ToyEntryRepository extends ServiceEntityRepository
{
    /** @use BaseActionsTrait<ToyEntry> */
    use BaseActionsTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ToyEntry::class);
    }

    public function countForToy(Toy $toy): int
    {
        return (int) $this->createQueryBuilder('toy_entry')
            ->select('COUNT(toy_entry.id)')
            ->where('toy_entry.toy = :toy')
            ->setParameter('toy', $toy)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    public function countForToyAndUser(Toy $toy, User $user): int
    {
        return (int) $this->createQueryBuilder('toy_entry')
            ->select('COUNT(toy_entry.id)')
            ->where('toy_entry.toy = :toy')
            ->setParameter('toy', $toy)
            ->andWhere('toy_entry.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }
}
