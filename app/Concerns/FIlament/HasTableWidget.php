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
        throw new \Exception('Override getTableWidgetHeading() to set the table widget heading.', 1);
    }

    public function updateTableWidget($column, $value)
    {
        // dd($column, $value);
        $this->dispatch(TableWidget::$filterDataUpdatedEventName, column: $column, value: $value);
    }
}
