<?php

declare(strict_types=1);

namespace App\Controller;

use App\Enum\Core\Type;

/**
 * @method void addFlash(string $type, mixed $message)
 */
trait FlashTrait
{
    public function addSuccessFlash(string $message): void
    {
        $this->addFlash(Type::SUCCESS->value, $message);
    }
}
