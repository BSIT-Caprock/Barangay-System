<?php

namespace App\Filament\Widgets;

use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;

class TableWidget extends BaseWidget
{
    public string $resource;

    public ?string $tableHeading = null;

    public static string $setWhereClauseEventName = 'table-widget-set-where-clause';

    public static string $removeWhereClauseEventName = 'table-widget-remove-where-clause';

    protected array $whereClauses = [];

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
                $query = $livewire->getResource()::getEloquentQuery();
                if (empty($livewire->whereClauses)) {
                    return $query->whereRaw('1 = 0');
                }
                foreach (array_values($livewire->whereClauses) as $array) {
                    $query->where($array['column'], $array['operator'], $array['value'], $array['boolean']);
                }

                return $query;
            });
    }

    /**
     * Add a basic where clause to the table widget.
     *
     * @param  \Closure|string|array|\Illuminate\Contracts\Database\Query\Expression  $column
     * @param  mixed  $operator
     * @param  mixed  $value
     * @param  string  $boolean
     */
    #[On('table-widget-set-where-clause')]
    public function setWhereClause($column, $operator = null, $value = null, $boolean = 'and')
    {
        $this->whereClauses[$column] = [
            'column' => $column,
            'operator' => $operator,
            'value' => $value,
            'boolean' => $boolean,
        ];
    }

    #[On('table-widget-remove-where-clause')]
    public function removeWhereClause(string $column)
    {
        unset($this->whereClauses[$column]);
    }
}
