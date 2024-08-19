<?php

namespace App\Filament\Resources\RbiHouseholdResource\Pages;

use App\Filament\Pages\FindOrCreateRecord;
use App\Filament\Resources\RbiHouseholdResource;
use App\Filament\Widgets\ResourcePageTableWidget;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRbiHousehold extends FindOrCreateRecord
{
    protected static string $resource = RbiHouseholdResource::class;

    protected static array $identityFields = [
        'number',
    ];

    protected function getWhereClauses(string $fieldName, mixed $value)
    {
        return match ($fieldName) {
            'number' => [
                ['number', 'like', "%{$value}%"],
            ],
            default => null,
        };
    }
}
