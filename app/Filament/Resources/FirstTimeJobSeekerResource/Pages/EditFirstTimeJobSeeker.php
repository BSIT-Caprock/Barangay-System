<?php

namespace App\Filament\Resources\FirstTimeJobSeekerResource\Pages;

use App\Filament\Resources\FirstTimeJobSeekerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFirstTimeJobSeeker extends EditRecord
{
    protected static string $resource = FirstTimeJobSeekerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
