<?php

namespace App\Form\User;

use App\Command\User\UserEditProfileCommand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserEditProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('username', TextType::class, [
            'label' => 'Nom d’utilisateur',
            'attr' => ['autofocus' => true],
        ]);

        $builder->add('email', EmailType::class, [
            'label' => 'Adresse e-mail',
        ]);

        $builder->add('hideCollection', CheckboxType::class, [
            'label' => 'Rendre ma collection privée',
            'required' => false,
        ]);

        $builder->add('hideWishlist', CheckboxType::class, [
            'label' => 'Rendre ma wishlist privée',
            'required' => false,
        ]);

        // ToDo Editer avatar

        $builder->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserEditProfileCommand::class,
        ]);
    }
}
