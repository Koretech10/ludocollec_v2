<?php

declare(strict_types=1);

namespace App\Twig\Extension;

use App\Enum\Core\Type;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class GlobalExtension extends AbstractExtension implements GlobalsInterface
{
    /**
     * @var array<string, class-string<\UnitEnum>>
     */
    private iterable $enums = [
        'Type' => Type::class,
    ];

    public function getGlobals(): array
    {
        $globals = [];

        foreach ($this->enums as $name => $enum) {
            $values = [];

            foreach ($enum::cases() as $case) {
                $values[$case->name] = $case;
            }

            $globals[$name] = $values;
        }

        return $globals;
    }
}
