<?php

namespace App\Filament\Resources\Ra11261FirstTimeJobseekerResource\Pages;

use App\Filament\Resources\Ra11261FirstTimeJobseekerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRa11261FirstTimeJobseekers extends ListRecords
{
    protected static string $resource = Ra11261FirstTimeJobseekerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
