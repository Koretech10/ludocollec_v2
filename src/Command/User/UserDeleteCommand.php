<?php

namespace App\Command\User;

use App\Entity\User\User;
use Symfony\Component\Messenger\Attribute\AsMessage;

#[AsMessage]
readonly class UserDeleteCommand
{
    public function __construct(public User $user)
    {
    }
}
