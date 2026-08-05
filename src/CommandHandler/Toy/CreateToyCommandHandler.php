<?php

declare(strict_types=1);

namespace App\CommandHandler\Toy;

use App\Command\Toy\CreateToyCommand;
use App\Entity\Toy\Toy;
use App\Event\Toy\ToyCreatedEvent;
use App\Repository\Toy\ToyRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

#[AsMessageHandler]
readonly class CreateToyCommandHandler
{
    public function __construct(
        private ToyRepository $toyRepository,
        private EventDispatcherInterface $eventDispatcher,
    ) {
    }

    public function __invoke(CreateToyCommand $command): int
    {
        $toy = new Toy(
            $command->name,
            $command->manufacturer,
            $command->series,
            $command->releaseDate,
            $command->author,
        );

        // ToDo Upload image

        $this->toyRepository->persistAndFlush($toy);

        $this->eventDispatcher->dispatch(new ToyCreatedEvent($toy));

        return $toy->getId();
    }
}
