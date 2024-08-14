<?php

namespace App\Concerns\Filament;

use App\Filament\Widgets\TableWidget;

trait HasTableWidget
{
    protected function getTableWidget()
    {
        return TableWidget::make([
            'resource' => $this->getResource(),
            'tableHeading' => $this->getTableWidgetHeading(),
        ]);
    }

    public function getTableWidgetHeading()
    {
        return null;
    }

    /**
     * Add a basic where clause to the widget table.
     *
     * @param  \Closure|string|array|\Illuminate\Contracts\Database\Query\Expression  $column
     * @param  mixed  $operator
     * @param  mixed  $value
     * @param  string  $boolean
     */
    public function setTableWidgetWhereClause($column, $operator = null, $value = null, $boolean = 'and')
    {
        $this->dispatch(TableWidget::$setWhereClauseEventName, $column, $operator, $value, $boolean);
    }

    public function removeTableWidgetWhereClause(string $column)
    {
        $this->dispatch(TableWidget::$removeWhereClauseEventName, $column);
    }
}
