<?php

declare(strict_types=1);

namespace App\Event\Toy;

use App\Entity\Toy\Series;
use Symfony\Contracts\EventDispatcher\Event;

class SeriesCreatedEvent extends Event
{
    public function __construct(
        public readonly Series $series,
    ) {
    }
}
