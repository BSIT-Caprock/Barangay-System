<?php

namespace App\Filament\Forms;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class SelectCourse extends Select
{
    public static function make(string $name = 'course_id'): static
    {
        return parent::make($name)
            ->relationship('course', 'name')
            ->searchable()
            ->preload()
            ->createOptionForm([
                TextInput::make('name')
                    ->required(),
            ]);
    }
}
