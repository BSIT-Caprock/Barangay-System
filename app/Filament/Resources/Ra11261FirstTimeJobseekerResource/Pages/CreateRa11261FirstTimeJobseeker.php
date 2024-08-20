<?php

namespace App\Filament\Resources\Ra11261FirstTimeJobseekerResource\Pages;

use App\Filament\Pages\FindOrCreateRecord;
use App\Filament\Resources\Ra11261FirstTimeJobseekerResource;

class CreateRa11261FirstTimeJobseeker extends FindOrCreateRecord
{
    protected static string $resource = Ra11261FirstTimeJobseekerResource::class;

    protected static array $identityFields = [
        'last_name',
        'first_name',
        'middle_name',
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
