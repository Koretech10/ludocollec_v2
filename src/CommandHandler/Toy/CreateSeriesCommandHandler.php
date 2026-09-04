<?php

declare(strict_types=1);

namespace App\CommandHandler\Toy;

use App\Command\Toy\CreateSeriesCommand;
use App\Entity\Toy\Series;
use App\Event\Toy\SeriesCreatedEvent;
use App\Repository\Toy\SeriesRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

#[AsMessageHandler]
readonly class CreateSeriesCommandHandler
{
    public function __construct(
        private SeriesRepository $seriesRepository,
        private EventDispatcherInterface $eventDispatcher,
    ) {
    }

    public function __invoke(CreateSeriesCommand $command): void
    {
        $series = new Series($command->name, $command->brand);

        $this->seriesRepository->persistAndFlush($series);

        $this->eventDispatcher->dispatch(new SeriesCreatedEvent($series));
    }
}
