<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InhabitantResource\Pages;
use App\Filament\Resources\InhabitantResource\RelationManagers;
use App\Filament\Resources\InhabitantResource\Widgets\InhabitantCount;
use App\FilamentExcel\WriterType;
use App\Models\Inhabitant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class InhabitantResource extends Resource
{
    protected static ?string $model = Inhabitant::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(4)->schema([
                Forms\Components\Select::make('barangay_id')
                    // ->label('Barangay')
                    ->required()
                    ->relationship('barangay', 'name')
                    // hidden if user has barangay
                    ->hidden((bool) auth()->user()->barangay),
                Forms\Components\Select::make('household_id')
                    ->label('Household number')
                    ->relationship('household', 'number')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('number')
                            ->required(),
                    ]),
            ]),
            Forms\Components\Grid::make(4)->schema([
                Forms\Components\TextInput::make('last_name')
                    ->required(),
                Forms\Components\TextInput::make('first_name')
                    ->required(),
                Forms\Components\TextInput::make('middle_name'),
                Forms\Components\TextInput::make('extension_name'),
            ]),
            Forms\Components\Grid::make(3)->schema([
                Forms\Components\Select::make('house_id')
                    ->relationship('house', 'number')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('number')
                            ->required(),
                    ]),
                Forms\Components\Select::make('street_id')
                    ->relationship('street', 'name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                    ]),
                Forms\Components\Select::make('zone_id')
                    ->relationship('zone', 'name'),
            ]),
            Forms\Components\Grid::make(3)->schema([
                Forms\Components\DatePicker::make('birth_date')
                    ->label('Date of birth')
                    ->required(),
                Forms\Components\Select::make('birth_place_id')
                    ->label('Place of birth')
                    ->relationship('birth_place', 'name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('province')
                            ->required(),
                        Forms\Components\TextInput::make('city_or_municipality')
                            ->label('City/Municipality')
                            ->required(),
                        Forms\Components\TextInput::make('name')
                            ->label('Label (optional)')
                    ]),
                Forms\Components\Select::make('sex_id')
                    // ->label('Sex')
                    ->required()
                    ->relationship('sex', 'name'),
                Forms\Components\Select::make('civil_status_id')
                    ->relationship('civil_status', 'name'),
                Forms\Components\Select::make('citizenship_id')
                    ->relationship('citizenship', 'name'),
                Forms\Components\Select::make('occupation_id')
                    ->relationship('occupation', 'name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                    ]),
            ]),
            Forms\Components\Grid::make(4)->schema([
                Forms\Components\DatePicker::make('date_accomplished'),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('barangay')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('household.number')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('last_name')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('first_name')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('middle_name')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('extension_name')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('full_name')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('house')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('street')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('zone')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('address')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('birth_date')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('age')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('birth_place')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('sex')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('civil_status')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('citizenship')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('occupation')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('date_accomplished')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->headerActions([
                ExportAction::make('export_table')->label('Export table')
                    ->exports([
                        ExcelExport::make('export')->fromTable()
                            ->askForWriterType(options: WriterType::options()),
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                ExportBulkAction::make('export_selected')->label('Export selected')
                    ->exports([
                        ExcelExport::make('export')->fromTable()
                            ->askForWriterType(options: WriterType::options()),
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
            'index' => Pages\ListInhabitants::route('/'),
            'create' => Pages\CreateInhabitant::route('/create'),
            'edit' => Pages\EditInhabitant::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            InhabitantCount::class,
        ];
    }
}
