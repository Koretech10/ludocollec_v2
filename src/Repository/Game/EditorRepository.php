<?php

declare(strict_types=1);

namespace App\Repository\Game;

use App\Entity\Game\Editor;
use App\Repository\BaseActionsTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EditorRepository extends ServiceEntityRepository
{
    /** @use BaseActionsTrait<Editor> */
    use BaseActionsTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Editor::class);
    }
}
