<?php

declare(strict_types=1);

namespace App\Repository\Wishlist;

use App\Entity\Wishlist\ExtensionEntry;
use App\Repository\BaseActionsTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ExtensionEntryRepository extends ServiceEntityRepository
{
    /** @use BaseActionsTrait<ExtensionEntry> */
    use BaseActionsTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExtensionEntry::class);
    }
}
