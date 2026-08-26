<?php

declare(strict_types=1);

namespace App\Form\Toy;

use App\Command\Toy\CreateToyCommand;
use App\Form\Core\Type\PreviewableImageType;
use App\Form\Toy\Type\ManufacturerAutocompleteType;
use App\Form\Toy\Type\SeriesAutocompleteType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateToyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('name', TextType::class, [
            'label' => 'Nom du jouet vidéo',
        ]);

        $builder->add('series', SeriesAutocompleteType::class);

        $builder->add('manufacturer', ManufacturerAutocompleteType::class);

        $builder->add('releaseDate', DateType::class, [
            'label' => 'Date de première sortie',
        ]);

        $builder->add('image', PreviewableImageType::class, [
            'label' => 'Image du jouet vidéo',
        ]);

        $builder->add('submit', SubmitType::class, [
            'label' => 'Créer',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CreateToyCommand::class,
        ]);
    }
}
