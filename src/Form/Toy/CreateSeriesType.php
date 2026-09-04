<?php

declare(strict_types=1);

namespace App\Form\Toy;

use App\Command\Toy\CreateSeriesCommand;
use App\Enum\Toy\Brand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateSeriesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('name', TextType::class, [
            'label' => 'Nom',
        ]);

        $builder->add('brand', EnumType::class, [
            'label' => 'Marque',
            'class' => Brand::class,
            'choice_label' => 'label',
        ]);

        $builder->add('submit', SubmitType::class, [
            'label' => 'Créer',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CreateSeriesCommand::class,
        ]);
    }
}
