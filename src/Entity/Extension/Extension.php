<?php

declare(strict_types=1);

namespace App\Entity\Extension;

use App\Entity\Creatable;
use App\Entity\Game\Developer;
use App\Entity\Game\Editor;
use App\Entity\Game\Game;
use App\Entity\Lockable;
use App\Entity\Validatable;
use App\Enum\Extension\Type;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'extensions')]
class Extension
{
    use Lockable;
    use Creatable;
    use Validatable;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(name: 'extension_type_id', enumType: Type::class)]
    private Type $type;

    #[ORM\ManyToOne(targetEntity: Game::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Game $game;

    #[ORM\Column(name: 'extension_name')]
    private string $name;

    #[ORM\Column(name: 'extension_release_date', type: Types::DATE_MUTABLE)]
    private \DateTime $releaseDate;

    #[ORM\Column(name: 'is_extension_new', type: Types::BOOLEAN)]
    private bool $isNew;

    #[ORM\ManyToOne(targetEntity: Developer::class)]
    #[ORM\JoinColumn(name: 'extension_developer_id', nullable: false)]
    private Developer $developer;

    #[ORM\ManyToOne(targetEntity: Editor::class)]
    #[ORM\JoinColumn(name: 'extension_editor_id', nullable: false)]
    private Editor $editor;
}
