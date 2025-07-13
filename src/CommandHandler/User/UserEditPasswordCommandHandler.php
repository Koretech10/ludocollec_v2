<?php

namespace App\CommandHandler\User;

use App\Command\User\UserEditPasswordCommand;
use App\Repository\User\UserRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsMessageHandler]
readonly class UserEditPasswordCommandHandler
{
    public function __construct(
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $passwordHasher,
    ) {
    }

    public function __invoke(UserEditPasswordCommand $command): void
    {
        $user = $command->user;

        $hashedPassword = $this->passwordHasher->hashPassword($user, $command->newPassword);

        $user->setPassword($hashedPassword);

        $this->userRepository->flush();
    }
}
