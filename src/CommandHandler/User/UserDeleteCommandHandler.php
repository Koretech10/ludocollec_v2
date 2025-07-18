<?php

namespace App\CommandHandler\User;

use App\Command\User\UserDeleteCommand;
use App\Repository\User\UserRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class UserDeleteCommandHandler
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(UserDeleteCommand $command): void
    {
        $user = $command->user;

        $this->userRepository->remove($user);
        $this->userRepository->flush();
    }
}
