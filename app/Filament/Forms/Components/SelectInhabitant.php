<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Select;

class SelectInhabitant extends Select
{
    public static function make(string $name = 'inhabitant_id'): static
    {
        return parent::make($name)
            ->relationship('inhabitant', 'last_name')
            ->preload()
            ->searchable(['last_name', 'first_name', 'middle_name']);
    }
}
