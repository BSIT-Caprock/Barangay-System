<?php

namespace App\Filament\Resources\Ra11261FirstTimeJobseekerResource\Pages;

use App\Filament\Resources\Ra11261FirstTimeJobseekerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRa11261FirstTimeJobseeker extends EditRecord
{
    protected static string $resource = Ra11261FirstTimeJobseekerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
