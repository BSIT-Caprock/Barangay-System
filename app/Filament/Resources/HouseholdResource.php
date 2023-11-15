<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HouseholdResource\Pages;
use App\Filament\Resources\HouseholdResource\RelationManagers;
use App\Filament\Resources\HouseholdResource\Widgets\HouseholdCount;
use App\Models\Household;
use App\Specifications\UserSpecification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Maatwebsite\Excel\Excel;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class HouseholdResource extends Resource
{
    protected static ?string $model = Household::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('barangay_id')
                    ->label('Barangay')
                    ->required()
                    ->relationship('barangay', 'name')
                    // hidden if user has barangay
                    ->hidden(UserSpecification::hasBarangay()),
                Forms\Components\TextInput::make('number')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('barangay.name')
                    // hidden if user has barangay id
                    ->hidden(UserSpecification::hasBarangay()),
                Tables\Columns\TextColumn::make('number'),
                Tables\Columns\TextColumn::make('inhabitants_count')
                    ->counts('inhabitants'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->headerActions([
                ExportAction::make('export_table')->label('Export table')
                    ->exports([
                        ExcelExport::make('export')->fromTable()
                            ->askForWriterType(options: [
                                Excel::CSV => 'Comma Separated Values (*.csv)',
                                Excel::XLS => 'Microsoft Excel 97-2003 Worksheet (*.xls)',
                                Excel::XLSX => 'Microsoft Excel Worksheet (*.xlsx)',
                            ]),
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                ExportBulkAction::make('export_selected')->label('Export selected')
                ->exports([
                    ExcelExport::make('export')->fromTable()
                        ->askForWriterType(options: [
                            Excel::CSV => 'Comma Separated Values (*.csv)',
                            Excel::XLS => 'Microsoft Excel 97-2003 Worksheet (*.xls)',
                            Excel::XLSX => 'Microsoft Excel Worksheet (*.xlsx)',
                        ]),
                ]),
                Tables\Actions\RestoreBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHouseholds::route('/'),
            'create' => Pages\CreateHousehold::route('/create'),
            'edit' => Pages\EditHousehold::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            HouseholdCount::class,
        ];
    }
}
