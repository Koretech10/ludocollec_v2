<?php

declare(strict_types=1);

namespace App\Event\Toy;

use App\Entity\Toy\Toy;
use Symfony\Contracts\EventDispatcher\Event;

class ToyCreatedEvent extends Event
{
    public function __construct(
        public readonly Toy $toy,
    ) {
    }
}
