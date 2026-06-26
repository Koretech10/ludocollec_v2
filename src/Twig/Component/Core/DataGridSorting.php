<?php

declare(strict_types=1);

namespace App\Twig\Component\Core;

use App\Collection\Core\DataGridHeaderCollection;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\RouterInterface;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('data-grid-sorting')]
class DataGridSorting
{
    private string $route;
    private array $query;
    private ?string $currentField;
    private string $currentDirection;

    public DataGridHeaderCollection $headers;

    public function __construct(
        private readonly RouterInterface $router,
        RequestStack $requestStack,
    ) {
        $request = $requestStack->getCurrentRequest();

        if (null === $request) {
            throw new \LogicException('RequestStack doit avoir une Request');
        }

        /** @var string $route */
        $route = $request->attributes->get('_route');

        /** @var ?string $field */
        $field = $request->query->get('field');

        /** @var string $direction */
        $direction = $request->query->get('direction', 'asc');

        $this->route = $route;
        $this->query = $request->query->all();
        $this->currentField = $field;
        $this->currentDirection = $direction;
    }

    public function getUrl(string $key): string
    {
        return $this->router->generate(
            $this->route,
            \array_merge($this->query, [
                'field' => $key,
                'direction' => $this->getDirection($key),
            ]),
        );
    }

    public function isActive(string $key): bool
    {
        return $this->currentField === $key;
    }

    public function getCurrentDirection(): string
    {
        return $this->currentDirection;
    }

    public function getDirection(string $key): string
    {
        // On inverse la direction du tri si on n'a pas changé de clé.
        if ($this->isActive($key)) {
            return match ($this->currentDirection) {
                'asc' => 'desc',
                default => 'asc',
            };
        }

        // On ne change pas la direction si on change de clé.
        return $this->currentDirection;
    }
}
