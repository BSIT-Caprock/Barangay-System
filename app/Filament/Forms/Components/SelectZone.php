<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Select;

class SelectZone extends Select
{
    public static function make(string $name = 'zone_id'): static
    {
        return parent::make($name)
            ->relationship('zone', 'name');
    }
}
