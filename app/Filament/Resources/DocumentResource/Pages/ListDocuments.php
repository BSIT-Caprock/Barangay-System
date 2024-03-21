<?php

namespace App\Filament\Resources\DocumentResource\Pages;

use App\Filament\Resources\DocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Excel;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ListDocuments extends ListRecords
{
    protected static string $resource = DocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
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
                ]),
            Actions\CreateAction::make()
                ->label('Upload document')
                ->modalHeading('Upload document')
                ->url(null),
        ];
    }
}
