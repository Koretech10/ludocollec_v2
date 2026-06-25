<?php

declare(strict_types=1);

namespace App\Form\Toy\Filter;

use App\Form\Core\Filter\FilterType;
use App\Form\Toy\Filter\Type\ManufacturerFilterType;
use App\Form\Toy\Filter\Type\SeriesFilterType;
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

        $builder->add('manufacturer', ManufacturerFilterType::class);

        $builder->add('series', SeriesFilterType::class);

        $builder->add('releaseDate', DateRangeFilterType::class, [
            'label' => 'Date de sortie',
        ]);
    }
}
