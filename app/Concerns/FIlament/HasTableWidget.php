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

    public function updateTableWidget($column, $value)
    {
        // dd($column, $value);
        $this->dispatch(TableWidget::$filterDataUpdatedEventName, column: $column, value: $value);
    }
}
