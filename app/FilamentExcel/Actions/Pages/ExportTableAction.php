<?php

namespace App\FilamentExcel\Actions\Pages;

use Maatwebsite\Excel\Excel;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ExportTableAction extends \pxlrbt\FilamentExcel\Actions\Pages\ExportAction
{
    protected function setUp(): void
    {
        parent::setUp();
        $this
            ->label('Export table')
            ->color('gray')
            ->exports([
                ExcelExport::make('export_table')
                    ->fromTable()
                    ->askForWriterType(options: [
                        Excel::CSV => 'Comma Separated Values (*.csv)',
                        Excel::XLS => 'Microsoft Excel 97-2003 Worksheet (*.xls)',
                        Excel::XLSX => 'Microsoft Excel Worksheet (*.xlsx)',
                    ])
            ]);
    }
}
