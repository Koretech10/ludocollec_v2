<?php

declare(strict_types=1);

namespace App\Twig\Component\Toy;

use App\Command\Toy\CreateSeriesCommand;
use App\Form\Toy\CreateSeriesType;
use App\Twig\Component\LiveEventDispatcherTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('toy:live-type:create-series')]
final class CreateSeriesLiveType extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;
    use LiveEventDispatcherTrait;

    public function __construct(
        private readonly MessageBusInterface $commandBus,
    ) {
    }

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(CreateSeriesType::class, new CreateSeriesCommand());
    }

    #[LiveAction]
    public function save(): void
    {
        $this->submitForm();

        /** @var CreateSeriesCommand $command */
        $command = $this->getForm()->getData();

        $this->commandBus->dispatch($command);

        // FLASH

        $this->dispatchCloseModalEvent('toy:live-type:create-series');

        $this->resetForm();
    }
}
