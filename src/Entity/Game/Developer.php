<?php

declare(strict_types=1);

namespace App\Entity\Game;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'game_developers')]
class Developer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(name: 'game_developer_name')]
    private string $name;

    #[ORM\Column(name: 'is_game_developer_new', type: Types::BOOLEAN)]
    private bool $isNew;
}
