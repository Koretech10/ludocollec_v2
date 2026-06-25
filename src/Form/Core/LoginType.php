<?php

declare(strict_types=1);

namespace App\Form\Core;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('_username', TextType::class, [
            'label' => 'Nom d’utilisateur',
            'data' => $options['lastUsername'],
            'attr' => [
                'autofocus' => true,
            ],
        ]);

        $builder->add('_password', PasswordType::class, [
            'label' => 'Mot de passe',
        ]);

        $builder->add('_remember_me', CheckboxType::class, [
            'label' => 'Se souvenir de moi',
            'required' => false,
        ]);

        $builder->add('submit', SubmitType::class, [
            'label' => 'Se connecter',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired(['lastUsername']);

        $resolver->setDefaults([
            'csrf_protection' => true,
            'csrf_field_name' => '_csrf_token',
            'csrf_token_id' => 'authenticate',
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
