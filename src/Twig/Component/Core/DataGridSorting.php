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

        $this->route = $route;
        $this->query = $request->query->all();
    }

    public function getUrl(string $key): string
    {
        return $this->router->generate(
            $this->route,
            \array_merge($this->query, [
                'field' => $key,
                'direction' => $this->getDirection(),
            ]),
        );
    }

    public function getDirection(): string
    {
        return 'asc';
    }
}
