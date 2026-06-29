<?php

declare(strict_types=1);

namespace App\Security;

use App\Entity\User\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user): void
    {
    }

    public function checkPostAuth(UserInterface $user, ?TokenInterface $token = null): void
    {
        if (!$user instanceof User) {
            return;
        }

        $this->checkIfUserIsActive($user);
    }

    private function checkIfUserIsActive(User $user): void
    {
        if (!$user->isActive()) {
            // ToDo Ajouter un lien vers le renvoi de mail d'activation quand la méthode sera reprise.
            throw new CustomUserMessageAccountStatusException(\sprintf('Votre compte n’a pas été activé. Veuillez l’activer grâce au lien se trouvant dans l’e-mail de
                confirmation de votre inscription. Pour renvoyer l’e-mail de confirmation d’inscription, <a href="%s">
                cliquez ici.</a>', '#', ));
        }
    }
}
