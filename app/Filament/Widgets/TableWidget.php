<?php

namespace App\Filament\Widgets;

use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;

class TableWidget extends BaseWidget
{
    public string $resource;

    public static string $filterDataUpdatedEventName = 'table-widget-updated';

    public string $tableHeading;

    protected array $filterData = [];

    /** @return  class-string<\Filament\Resources\Resource>*/
    protected function getResource(): string
    {
        return $this->resource;
    }

    public function table(Table $table): Table
    {
        return $this->getResource()::table($table)
            ->heading($this->tableHeading)
            ->modelLabel($this->getResource()::getModelLabel())
            ->searchable(false)
            ->selectable(false)
            ->query(function (self $livewire): Builder {
                return $livewire->getResource()::getEloquentQuery();
            });
    }

    #[On('table-widget-updated')]
    public function updateFilterData(string $column, mixed $value)
    {
        $this->filterData[$column] = $value;
    }

    protected function getFilterDataValue(string $column)
    {
        if (! array_key_exists($column, $this->filterData)) {
            return null;
        }

        return $this->filterData[$column];
    }
}
