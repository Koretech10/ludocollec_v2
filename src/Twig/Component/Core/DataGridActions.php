<?php

declare(strict_types=1);

namespace App\Twig\Component\Core;

use App\Collection\Core\DataGridActionCollection;
use App\Entity\ImageableEntity;
use App\Model\Core\DataGrid\DataGridAction;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('data-grid-actions')]
class DataGridActions
{
    public DataGridActionCollection $actions;
    public ImageableEntity $item;

    public function __construct(
        private readonly UrlGeneratorInterface $urlGenerator,
    ) {
    }

    public function getActionHref(DataGridAction $action): string
    {
        return $this->urlGenerator->generate($action->route, $action->resolveRouteParameters($this->item));
    }
}
