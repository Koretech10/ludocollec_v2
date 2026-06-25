<?php

declare(strict_types=1);

namespace App\Form\Core\Filter;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class FilterType extends AbstractType
{
    public const string TRANSLATION_DOMAIN = 'SpiriitFormFilterBundle';

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'translation_domain' => false,
            'csrf_protection' => false,
            'method' => 'GET',
        ]);
    }
}
