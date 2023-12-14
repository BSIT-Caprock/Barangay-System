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
                ->example('Poblacion Dist. I')
                ->requiredMapping()
                ->relationship(resolveUsing: 'name')
                ->rules(['required']),

            ImportColumn::make('last_name')
                ->example('Cruz'),

            ImportColumn::make('first_name')
                ->example('Juan'),

            ImportColumn::make('middle_name'),

            ImportColumn::make('extension_name')
                ->example('Paz'),

            ImportColumn::make('birth_date')
                ->example('1999-09-09'),

            ImportColumn::make('date_accomplished')
                ->example('2023-01-01'),

            ImportColumn::make('birth_place')
                ->example('Barugo, Leyte')
                ->relationship(resolveUsing: ['name', 'city_or_municipality']),

            ImportColumn::make('sex')
                ->example('Male')
                ->relationship(resolveUsing: 'name'),

            ImportColumn::make('civil_status')
                ->example('Single')
                ->relationship(resolveUsing: 'name'),

            ImportColumn::make('citizenship')
                ->example('Filipino')
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
