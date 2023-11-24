<?php

namespace App\Filament\Forms;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class SelectHouseholdNumber extends Select
{
    public static function make(string $name = 'household_id'): static
    {
        return parent::make($name)
            ->label('Household number')
            ->relationship('household', 'number')
            ->searchable()
            ->preload()
            ->createOptionForm([
                TextInput::make('number')
                    ->required(),
            ]);
    }
}
