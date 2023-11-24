<?php

namespace App\Filament\Forms;

use Filament\Forms\Components\Select;

class SelectSex extends Select
{
    public static function make(string $name = 'sex_id'): static
    {
        return parent::make($name)
            ->relationship('sex', 'name');
    }
}
