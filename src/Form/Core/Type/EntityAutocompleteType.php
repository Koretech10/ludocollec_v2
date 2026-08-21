<?php

declare(strict_types=1);

namespace App\Form\Core\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntityAutocompleteType extends ChoiceAutocompleteType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'autocomplete' => true,
        ]);
    }

    public function getParent(): string
    {
        return EntityType::class;
    }
}
