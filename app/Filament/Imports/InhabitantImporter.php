<?php

namespace App\Filament\Imports;

use App\Models\Inhabitant;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class InhabitantImporter extends Importer
{
    protected static ?string $model = Inhabitant::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('barangay')
                ->requiredMapping()
                ->relationship(resolveUsing: 'name')
                ->rules(['required']),

            ImportColumn::make('last_name'),

            ImportColumn::make('first_name'),

            ImportColumn::make('middle_name'),

            ImportColumn::make('extension_name'),

            ImportColumn::make('birth_date'),

            ImportColumn::make('date_accomplished'),

            ImportColumn::make('birth_place')
                ->relationship(resolveUsing: ['name', 'city_or_municipality']),

            ImportColumn::make('sex')
                ->relationship(resolveUsing: 'name'),

            ImportColumn::make('civil_status')
                ->relationship(resolveUsing: 'name'),

            ImportColumn::make('citizenship')
                ->relationship(resolveUsing: 'name'),

            ImportColumn::make('occupation')
                ->relationship(resolveUsing: 'name'),

            ImportColumn::make('house')
                ->relationship(resolveUsing: 'number'),

            ImportColumn::make('street')
                ->relationship(resolveUsing: 'name'),

            ImportColumn::make('zone')
                ->relationship(resolveUsing: 'name'),

            ImportColumn::make('household')
                ->relationship(resolveUsing: 'number'),
        ];
    }

    public function resolveRecord(): ?Inhabitant
    {
        // return Inhabitant::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Inhabitant();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your inhabitant import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
