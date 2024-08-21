<?php

namespace App\Filament\Resources\PrpwdPersonWithDisabilityResource\Pages;

use App\Filament\Pages\FindOrCreateRecord;
use App\Filament\Resources\PrpwdPersonWithDisabilityResource;

class CreatePrpwdPersonWithDisability extends FindOrCreateRecord
{
    protected static string $resource = PrpwdPersonWithDisabilityResource::class;

    protected static array $identityFields = [
        'last_name',  
        'first_name',  
        'middle_name',  
        'suffix',
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
            'suffix' => [
                ['suffix', 'like', "%{$value}%"],
            ],
            'address' => [
                ['address', 'like', "%{$value}%"],
            ],
            'disability_type' => [
                ['disability_type', '=', $value],
            ],
            'disability_cause' => [
                ['disability_cause', '=', $value],
            ],
            default => null,
        };
    }
}
