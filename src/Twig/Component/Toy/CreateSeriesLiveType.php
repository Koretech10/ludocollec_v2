<?php

declare(strict_types=1);

namespace App\Twig\Component\Toy;

use App\Command\Toy\CreateSeriesCommand;
use App\Form\Toy\CreateSeriesType;
use App\Twig\Component\LiveEventDispatcherTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
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

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(CreateSeriesType::class, new CreateSeriesCommand());
    }

    #[LiveAction]
    public function save(): void
    {
        $this->submitForm();

        // HANDLER

        $this->dispatchCloseModalEvent('toy:live-type:create-series');
    }
}
