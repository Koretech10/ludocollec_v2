<?php

declare(strict_types=1);

namespace App\Form\Core\Type;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChoiceAutocompleteType extends AutocompleteType
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
        return ChoiceType::class;
    }
}
