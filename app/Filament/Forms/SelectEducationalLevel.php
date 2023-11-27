<?php

namespace App\Filament\Forms;

use Filament\Forms\Components\Select;

class SelectEducationalLevel extends Select
{
    public static function make(string $name = 'educational_level_id'): static
    {
        return parent::make($name)
            ->relationship('educational_level', 'name');
    }
}
