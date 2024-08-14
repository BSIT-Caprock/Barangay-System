<?php

namespace App\Filament\Resources\RbiInhabitantResource\Pages;

use App\Concerns\Filament\HasTableWidget;
use App\Filament\Resources\RbiInhabitantResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRbiInhabitant extends CreateRecord
{
    use HasTableWidget;

    protected static string $resource = RbiInhabitantResource::class;

    protected function getFooterWidgets(): array
    {
        return [
            $this->getTableWidget(),
        ];
    }

    public function getFooterWidgetsColumns(): int|string|array
    {
        return 1;
    }
}
