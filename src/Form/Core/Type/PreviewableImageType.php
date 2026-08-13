<?php

declare(strict_types=1);

namespace App\Form\Core\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PreviewableImageType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'help' => 'Taille maximale : 2 Mo',
            'required' => false,
            'attr' => [
                'data-ludocollec-target' => 'image-input',
            ],
        ]);
    }

    public function getParent(): string
    {
        return FileType::class;
    }
}
