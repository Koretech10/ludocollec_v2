<?php

declare(strict_types=1);

namespace App\Form\Core\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AutocompleteType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'tom_select_options' => [
                'plugins' => [
                    'dropdown_input',
                ],
            ],
        ]);
    }
}
