<?php

declare(strict_types=1);

namespace App\Form\Core\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EntityAutocompleteType extends ChoiceAutocompleteType
{
    public function getParent(): string
    {
        return EntityType::class;
    }
}
