<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Select;

class SelectCivilStatus extends Select
{
    public static function make(string $name = 'civil_status_id'): static
    {
        return parent::make($name)
            ->relationship('civil_status', 'name');
    }
}
