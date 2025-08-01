<?php

declare(strict_types=1);

namespace App\Entity\Game;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;

#[ORM\Entity(readOnly: true)]
#[Table(name: 'game_editors')]
class Editor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(name: 'game_editor_name')]
    private string $name;

    #[ORM\Column(name: 'is_game_editor_new', type: Types::BOOLEAN)]
    private bool $isNew;
}
