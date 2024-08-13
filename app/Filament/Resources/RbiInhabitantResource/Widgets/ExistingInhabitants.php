<?php

namespace App\Filament\Resources\RbiInhabitantResource\Widgets;

use App\Filament\Resources\RbiInhabitantResource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ExistingInhabitants extends BaseWidget
{
    public function table(Table $table): Table
    {
        return RbiInhabitantResource::table($table)
            ->selectable(false)
            ->query(RbiInhabitantResource::getEloquentQuery());
    }
}
