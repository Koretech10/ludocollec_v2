<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\User\User;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait Validatable
{
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn]
    private ?User $validatedBy;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTime $validationDate;

    public function getValidatedBy(): ?User
    {
        return $this->validatedBy;
    }

    public function getValidationDate(): ?\DateTime
    {
        return $this->validationDate;
    }
}
