<?php

declare(strict_types=1);

namespace App\EventSubscriber\Form\Core;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Event\PreSubmitEvent;
use Symfony\Component\Form\FormEvents;

abstract class AutocompleteEntityCreatedSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SUBMIT => 'onPreSubmit',
        ];
    }

    public function onPreSubmit(PreSubmitEvent $event): void
    {
        $data = $event->getData();

        if ('' === $data || !\is_string($data)) {
            return;
        }

        if (!$this->handleEntity($data)) {
            return;
        }

        $id = $this->persistEntity($data);

        $event->setData($id);
    }

    // Vérifie si l'entité est déjà présente en base pour savoir s'il faut la créer ou non.
    abstract protected function handleEntity(string $data): bool;

    // Créer l'entité à partir de la donnée du champ et retourne son ID.
    abstract protected function persistEntity(string $data): string;
}
