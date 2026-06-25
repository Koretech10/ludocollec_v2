<?php

declare(strict_types=1);

namespace App\Form\Core;

use App\Collection\Core\DataGridHeaderCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /** @var DataGridHeaderCollection $headers */
        $headers = $options['headers'];

        $builder->add('field', ChoiceType::class, [
            'label' => false,
            'choices' => $headers->getHeadersWithKey(),
            'choice_label' => 'label',
            'choice_value' => 'key',
        ]);

        $builder->add('direction', ChoiceType::class, [
            'label' => false,
            'choices' => [
                'Ordre croissant' => 'asc',
                'Ordre décroissant' => 'desc',
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired('headers');

        $resolver->setAllowedTypes('headers', DataGridHeaderCollection::class);

        $resolver->setDefaults([
            'method' => 'GET',
            'csrf_protection' => false,
            'allow_extra_fields' => true,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
