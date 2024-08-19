<?php

namespace App\Filament\Resources\RbiInhabitantResource\Pages;

use App\Filament\Pages\FindOrCreateRecord;
use App\Filament\Resources\RbiInhabitantResource;

class CreateRbiInhabitant extends FindOrCreateRecord
{
    protected static string $resource = RbiInhabitantResource::class;

    protected static array $identityFields = [
        'last_name',
        'first_name',
        'middle_name',
        'extension_name',
        'birthplace',
        'birthdate',
        'sex',
    ];

    protected function getWhereClauses(string $fieldName, mixed $value)
    {
        return match ($fieldName) {
            'last_name' => [
                ['last_name', 'like', "%{$value}%"],
                ['middle_name', 'like', "%{$value}%", 'or'],
            ],
            'first_name' => [
                ['first_name', 'like', "%{$value}%"],
            ],
            'middle_name' => [
                ['middle_name', 'like', "%{$value}%"],
                ['last_name', 'like', "%{$value}%", 'or'],
            ],
            'extension_name' => [
                ['extension_name', 'like', "%{$value}%"],
            ],
            'birthplace' => [
                ['birthplace', 'like', "%{$value}%"],
            ],
            'birthdate' => [
                ['birthdate', '=', $value],
            ],
            'sex' => [
                ['sex', '=', $value],
            ],
            default => null,
        };
    }
}
