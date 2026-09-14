<?php

declare(strict_types=1);

namespace App\Twig\Component;

use Symfony\UX\LiveComponent\ComponentToolsTrait;

trait LiveEventDispatcherTrait
{
    use ComponentToolsTrait;

    public function dispatchCloseModalEvent(string $modalId): void
    {
        $this->dispatchBrowserEvent('modal:close', [
            'id' => $modalId,
        ]);
    }
}
