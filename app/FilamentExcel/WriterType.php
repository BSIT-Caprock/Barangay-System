<?php

namespace App\FilamentExcel;

use Maatwebsite\Excel\Excel;

class WriterType
{
    /**
     * options for excel export
     */
    public static function options()
    {
        return [
            Excel::CSV => 'Comma Separated Values (*.csv)',
            Excel::XLS => 'Microsoft Excel 97-2003 Worksheet (*.xls)',
            Excel::XLSX => 'Microsoft Excel Worksheet (*.xlsx)',
        ];
    }
}
