<?php

declare(strict_types=1);

namespace App\Form\Core\Type;

use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnumAutocompleteType extends ChoiceAutocompleteType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'choice_label' => 'label',
        ]);
    }

    public function getParent(): string
    {
        return EnumType::class;
    }
}
