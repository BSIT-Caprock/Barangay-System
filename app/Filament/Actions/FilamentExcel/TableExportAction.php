<?php

namespace App\Filament\Actions\FilamentExcel;

use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;

class TableExportAction extends ExportAction
{
    public static function make(?string $name = 'export_table'): static
    {
        return parent::make($name)
            ->label('Export table')
            ->color('gray')
            ->exports([Export::make()]);
    }
}
