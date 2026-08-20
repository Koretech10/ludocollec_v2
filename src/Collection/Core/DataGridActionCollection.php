<?php

declare(strict_types=1);

namespace App\Collection\Core;

use App\Model\Core\DataGrid\DataGridAction;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @extends ArrayCollection<int, DataGridAction>
 */
class DataGridActionCollection extends ArrayCollection
{
    public function hasShowableActions(object $item): bool
    {
        return !$this->filter(
            static function (DataGridAction $action) use ($item): bool {
                return true === $action->canShow($item);
            }
        )->isEmpty();
    }
}
