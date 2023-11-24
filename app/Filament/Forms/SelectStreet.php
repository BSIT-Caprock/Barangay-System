<?php

namespace App\Filament\Forms;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class SelectStreet extends Select
{
    public static function make(string $name = 'street_id'): static
    {
        return parent::make($name)
            ->relationship('street', 'name')
            ->searchable()
            ->preload()
            ->createOptionForm([
                TextInput::make('name')
                    ->required(),
            ]);
    }
}
