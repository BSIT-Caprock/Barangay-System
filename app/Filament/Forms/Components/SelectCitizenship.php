<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Select;

class SelectCitizenship extends Select
{
    public static function make(string $name = 'citizenship_id'): static
    {
        return parent::make($name)
            ->relationship('citizenship', 'name');
    }
}
