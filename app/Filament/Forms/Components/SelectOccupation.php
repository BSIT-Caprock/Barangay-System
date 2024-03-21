<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class SelectOccupation extends Select
{
    public static function make(string $name = 'occupation_id'): static
    {
        return parent::make($name)
            ->relationship('occupation', 'name')
            ->searchable()
            ->preload()
            ->createOptionForm([
                TextInput::make('name')
                    ->required(),
            ]);
    }
}
