<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class SelectBirthPlace extends Select
{
    public static function make(string $name = 'birth_place_id'): static
    {
        return parent::make($name)
            ->label('Place of birth')
            ->relationship('birth_place', 'name')
            ->searchable()
            ->preload()
            ->createOptionForm([
                TextInput::make('province')->required(),

                TextInput::make('city_or_municipality')->label('City/Municipality')->required(),

                TextInput::make('name')->label('Label (optional)'),
            ]);
    }
}
