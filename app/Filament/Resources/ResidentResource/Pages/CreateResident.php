<?php

namespace App\Filament\Resources\ResidentResource\Pages;

use App\Filament\Resources\ResidentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

// use\Filament\ResidentResources;

class CreateResident extends CreateRecord
{
    protected static string $resource = ResidentResource::class;
}


// protected function mutateFormDataBeforeCreate(array $data): array
//     {
//         $data['barangay_id'] = auth()->id();

//         return $data;
//     }