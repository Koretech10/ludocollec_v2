<?php

namespace App\Command\User;

use App\Entity\User\User;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Messenger\Attribute\AsMessage;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

#[AsMessage]
#[UniqueEntity(
    fields: ['email'],
    message: 'Cette adresse e-mail existe déjà.',
    entityClass: User::class,
    identifierFieldNames: ['id'],
)]
#[UniqueEntity(
    fields: ['username'],
    message: 'Ce nom d’utilisateur existe déjà.',
    entityClass: User::class,
    identifierFieldNames: ['id'],
)]
class UserEditProfileCommand
{
    public readonly int $id;

    #[NotBlank]
    #[Length(max: 255)]
    public string $username;

    #[NotBlank]
    #[Length(max: 255)]
    #[Email]
    public string $email;

    public bool $hideCollection;

    public bool $hideWishlist;

    // ToDo Editer l'avatar

    public function __construct(public readonly User $user)
    {
        $this->id = $user->getId();
        $this->username = $user->getUsername();
        $this->email = $user->getEmail();
        $this->hideCollection = $user->isCollectionHidden();
        $this->hideWishlist = $user->isWishlistHidden();
    }
}
