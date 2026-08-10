<?php

declare(strict_types=1);

namespace App\CommandHandler;

use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

trait CommandHandlerTrait
{
    private readonly MessageBusInterface $commandBus;

    /*
     * Cette méthode entre en conflit avec le principe CQRS car l'id des entités est autogénéré par la base de données.
     * Quand ceux-ci seront migrés vers des ULIDs, cette méthode pourra être dépréciée puis supprimée.
     */
    private function handleCommandAndGetId(object $command): int
    {
        $envelope = $this->commandBus->dispatch($command);
        $handledStamp = $envelope->last(HandledStamp::class);

        if (null === $handledStamp) {
            throw new \LogicException(\sprintf('Aucun résultat retourné pour la commande « %s ». La commande est-elle synchrone ?', $command::class));
        }

        $id = $handledStamp->getResult();

        if (!\is_int($id)) {
            throw new \UnexpectedValueException(\sprintf('$id doit être un integer, « %s » retourné.', \get_debug_type($id)));
        }

        return $id;
    }
}
