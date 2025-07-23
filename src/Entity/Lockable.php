<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\User\User;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait Lockable
{
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn]
    private ?User $locker;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTime $lockTimestamp;
}
