<?php

namespace App\Command\User;

use App\Entity\User\User;
use Symfony\Component\Messenger\Attribute\AsMessage;
use Symfony\Component\Validator\Constraints\Length;

#[AsMessage]
class UserEditPasswordCommand
{
//    #[UserPassword] // ToDo A vérifier quand l'authentification sera OK
    public string $oldPassword;

    #[Length(min: 8, minMessage: 'Le mot de passe doit avoir 8 caractères au minimum.')]
    public string $newPassword;

    public function __construct(public readonly User $user)
    {
    }
}
