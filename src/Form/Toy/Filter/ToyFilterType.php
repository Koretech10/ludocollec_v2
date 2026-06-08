<?php

declare(strict_types=1);

namespace App\Form\Toy\Filter;

use App\Form\Core\Filter\FilterType;
use Spiriit\Bundle\FormFilterBundle\Filter\FilterOperands;
use Spiriit\Bundle\FormFilterBundle\Filter\Form\Type\DateRangeFilterType;
use Spiriit\Bundle\FormFilterBundle\Filter\Form\Type\TextFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class ToyFilterType extends FilterType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('name', TextFilterType::class, [
            'label' => 'Nom',
            'compound' => true,
            'choice_options' => [
                'choices' => FilterOperands::getStringOperandsChoices(),
                'required' => true,
                'preferred_choices' => [FilterOperands::STRING_CONTAINS],
                'translation_domain' => self::TRANSLATION_DOMAIN,
            ],
        ]);

        $builder->add('releaseDate', DateRangeFilterType::class, [
            'label' => 'Date de sortie',
        ]);
    }
}
