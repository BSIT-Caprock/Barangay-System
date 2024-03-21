<?php

namespace App\FilamentExcel\Actions\Tables;

use App\FilamentExcel\Exports\MultiOptionExport;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;

class TableExportAction extends ExportAction
{
    public static function make(?string $name = 'export_table'): static
    {
        return parent::make($name)
            ->label('Export table')
            ->color('gray')
            ->exports([MultiOptionExport::make()]);
    }
}
