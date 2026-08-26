<?php

declare(strict_types=1);

namespace App\EventSubscriber\Form\Toy;

use App\Entity\Toy\Manufacturer;
use App\EventSubscriber\Form\Core\AutocompleteEntityCreatedSubscriber;
use App\Repository\Toy\ManufacturerRepository;

class ManufacturerCreatedSubscriber extends AutocompleteEntityCreatedSubscriber
{
    public function __construct(
        private readonly ManufacturerRepository $manufacturerRepository,
    ) {
    }

    protected function handleEntity(string $data): bool
    {
        return null === $this->manufacturerRepository->findOneById($data);
    }

    protected function persistEntity(string $data): string
    {
        $manufacturer = new Manufacturer($data);

        $this->manufacturerRepository->persistAndFlush($manufacturer);

        return (string) $manufacturer->getId();
    }
}
