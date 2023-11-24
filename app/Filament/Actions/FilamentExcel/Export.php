<?php

namespace App\Filament\Actions\FilamentExcel;

use Maatwebsite\Excel\Excel;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class Export extends ExcelExport
{
    public static function make(string $name = 'export'): static
    {
        return parent::make($name)
            ->fromTable()
            ->askForWriterType(options: static::exportOptions());
    }

    /**
     * options for excel export
     */
    public static function exportOptions()
    {
        return [
            Excel::CSV => 'Comma Separated Values (*.csv)',
            Excel::XLS => 'Microsoft Excel 97-2003 Worksheet (*.xls)',
            Excel::XLSX => 'Microsoft Excel Worksheet (*.xlsx)',
        ];
    }
}
