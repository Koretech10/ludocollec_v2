<?php

namespace App\CommandHandler\User;

use App\Command\User\UserEditProfileCommand;
use App\Repository\User\UserRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class UserEditProfileCommandHandler
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(UserEditProfileCommand $command): void
    {
        $user = $command->user;
        /** @var non-empty-string $username */
        $username = $command->username;

        $user->setUsername($username);
        $user->setEmail($command->email);
        $user->setHideCollection($command->hideCollection);
        $user->setHideWishlist($command->hideWishlist);

        $this->userRepository->flush();
    }
}
