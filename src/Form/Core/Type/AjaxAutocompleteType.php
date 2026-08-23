<?php

declare(strict_types=1);

namespace App\Form\Core\Type;

use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\BaseEntityAutocompleteType;

#[AsEntityAutocompleteField]
class AjaxAutocompleteType extends AutocompleteType
{
    public function getParent(): string
    {
        return BaseEntityAutocompleteType::class;
    }
}
