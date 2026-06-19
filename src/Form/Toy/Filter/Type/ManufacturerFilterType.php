<?php

declare(strict_types=1);

namespace App\Form\Toy\Filter\Type;

use App\Form\Core\Filter\FilterType;
use Spiriit\Bundle\FormFilterBundle\Filter\FilterBuilderExecuterInterface;
use Spiriit\Bundle\FormFilterBundle\Filter\FilterOperands;
use Spiriit\Bundle\FormFilterBundle\Filter\Form\Type\SharedableFilterType;
use Spiriit\Bundle\FormFilterBundle\Filter\Form\Type\TextFilterType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ManufacturerFilterType extends AbstractType
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
                'translation_domain' => FilterType::TRANSLATION_DOMAIN,
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'label' => 'Fabricant',
            'add_shared' => static function (FilterBuilderExecuterInterface $queryBuilder): void {
                $queryBuilder->addOnce(\sprintf('%s.manufacturer', $queryBuilder->getAlias()), 'manufacturer');
            },
            'block_prefix' => 'fieldset_filter',
        ]);
    }

    public function getParent(): string
    {
        return SharedableFilterType::class;
    }
}
