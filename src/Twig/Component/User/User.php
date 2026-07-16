<?php

declare(strict_types=1);

namespace App\Twig\Component\User;

use App\Entity\User\User as UserEntity;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'user', template: 'component/user/user.html.twig')]
class User
{
    public ?UserEntity $user = null;
    public string $nullMessage = 'Anonyme';

    public function getText(): string
    {
        if (null !== $this->user) {
            return (string) $this->user;
        }

        return $this->nullMessage;
    }
}
