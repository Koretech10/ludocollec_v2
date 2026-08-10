<?php

declare(strict_types=1);

namespace App\CommandHandler\Toy;

use App\Command\Toy\CreateToyCommand;
use App\Entity\Toy\Toy;
use App\Event\Toy\ToyCreatedEvent;
use App\Exception\Core\EntityNotManagedException;
use App\Exception\Core\InvalidMimeTypeException;
use App\Repository\Toy\ToyRepository;
use App\Util\Core\ImageManager;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

#[AsMessageHandler]
readonly class CreateToyCommandHandler
{
    public function __construct(
        private ToyRepository $toyRepository,
        private EventDispatcherInterface $eventDispatcher,
        private ImageManager $imageManager,
    ) {
    }

    /**
     * @throws InvalidMimeTypeException
     * @throws EntityNotManagedException
     */
    public function __invoke(CreateToyCommand $command): int
    {
        $image = $command->image;

        $toy = new Toy(
            $command->name,
            $command->manufacturer,
            $command->series,
            $command->releaseDate,
            $command->author,
        );

        $this->toyRepository->persistAndFlush($toy);

        if (null !== $image) {
            $this->imageManager->processUploadedFile($image, $toy);
        }

        $this->eventDispatcher->dispatch(new ToyCreatedEvent($toy));

        return $toy->getId();
    }
}
