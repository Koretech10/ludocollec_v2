<?php

declare(strict_types=1);

namespace App\Model\Core\DataGrid;

use App\Enum\Core\Icon;
use App\Enum\Core\Type;

/**
 * @template T of object
 */
readonly class DataGridAction
{
    public function __construct(
        public string $label, // Texte de l'action
        public string $route, // Route de l'action
        /** @var array<string, scalar|\Closure(T): scalar> $routeParameters */
        private array $routeParameters = [], // Paramètres à passer à la route de l'action
        /** @var bool|\Closure(T): bool $show */
        private bool|\Closure $show = true, // Condition pour afficher l'action (calculée à partir d'un Voter ou un IsGranted)
        public bool $confirm = false, // Affiche une pop-up pour confirmer l'action
        public string $confirmMessage = '', // Message de la pop-up de confirmation
        public ?Icon $icon = null, // Icône à afficher pour l'action
        public ?Type $type = null, // Applique la couleur du Type au texte de l'action
    ) {
    }

    /**
     * @param T $item
     *
     * @return array<string, scalar>
     */
    public function resolveRouteParameters(object $item): array
    {
        $routeParameters = [];

        foreach ($this->routeParameters as $key => $parameter) {
            if (!$parameter instanceof \Closure) {
                $routeParameters[$key] = $parameter;
            } else {
                $routeParameters[$key] = $parameter($item);
            }
        }

        return $routeParameters;
    }

    /**
     * @param T $item
     */
    public function canShow(object $item): bool
    {
        if (!$this->show instanceof \Closure) {
            return $this->show;
        }

        return ($this->show)($item);
    }

    /**
     * @template StaticT of object
     *
     * @param array<string, scalar|\Closure(StaticT): scalar> $parameters
     *
     * @return self<StaticT>
     */
    public static function consultAction(string $route, array $parameters): self
    {
        return new self(
            label: 'Consulter',
            route: $route,
            routeParameters: $parameters,
            icon: Icon::show,
        );
    }
}
