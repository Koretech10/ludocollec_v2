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
}
