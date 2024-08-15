<?php

namespace App\Filament\Widgets;

use Filament\Resources\Pages\CreateRecord;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;

class ResourcePageTableWidget extends BaseWidget
{
    const WHERE = 'existing-records-table-widget-update-query';

    /** @var class-string<\Filament\Resources\Resource> */
    public string $resource;

    public mixed $where;

    public array $tableProperties;

    protected int | string | array $columnSpan = 'full';

    /** @param class-string<CreateRecord> $resource */
    public static function makeWith(string $resource, mixed $initialWhere, array $tableProperties = [])
    {
        return static::make([
            'resource' => $resource,
            'where' => $initialWhere,
            'tableProperties' => $tableProperties,
        ]);
    }

    public function table(Table $table): Table
    {
        return $this->resource::table($table)
            ->heading($this->tableProperties['heading'] ?? 'Existing '.$this->resource::getPluralModelLabel())
            ->modelLabel($this->resource::getModelLabel())
            ->searchable($this->tableProperties['searchable'] ?? false)
            ->selectable($this->tableProperties['selectable'] ?? false)
            ->query(fn (self $livewire): Builder => $livewire->resource::getEloquentQuery()->where($livewire->where));
    }

    #[On(ResourcePageTableWidget::WHERE)]
    public function where(mixed $where)
    {
        $this->where = $where;
    }
}
