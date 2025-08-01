<?php

declare(strict_types=1);

namespace App\Entity\Game;

use App\Entity\Console\Console;
use App\Entity\Creatable;
use App\Entity\Lockable;
use App\Entity\Validatable;
use App\Enum\Game\Genre;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'games')]
class Game
{
    use Lockable;
    use Creatable;
    use Validatable;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Editor::class)]
    #[ORM\JoinColumn(name: 'game_editor_id', nullable: false)]
    private Editor $editor;

    #[ORM\ManyToOne(targetEntity: Developer::class)]
    #[ORM\JoinColumn(name: 'game_developer_id', nullable: false)]
    private Developer $developer;

    #[ORM\Column(name: 'game_genre_id', enumType: Genre::class)]
    private Genre $genre;

    #[ORM\Column(name: 'is_game_new', type: Types::BOOLEAN)]
    private bool $isNew;

    #[ORM\ManyToOne(targetEntity: Console::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Console $console;

    #[ORM\Column(name: 'game_name')]
    private string $name;

    #[ORM\Column(name: 'game_release_date', type: Types::DATE_MUTABLE)]
    private \DateTime $releaseDate;

    // ToDo Transformer en array, nécessitera certainement une migration
    #[ORM\Column(name: 'game_mode')]
    private string $mode;

    #[ORM\ManyToOne(targetEntity: Game::class, inversedBy: 'children')]
    #[ORM\JoinColumn(name: 'game_family_parent_id')]
    private Game $parent;

    /** @var ArrayCollection<Game> $children */
    #[ORM\OneToMany(targetEntity: Game::class, mappedBy: 'parent')]
    private Collection $children;
}
