<?php

namespace App\Filament\Forms;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class SelectHouseNumber extends Select
{
    public static function make(string $name = 'house_id'): static
    {
        return parent::make($name)
            ->label('House number')
            ->relationship('house', 'number')
            ->searchable()
            ->preload()
            ->createOptionForm([
                TextInput::make('number')
                    ->required(),
            ]);
    }
}
