<?php

namespace App\Filament\Resources;

use App\FilamentExcel\Actions\Tables\TableExportAction;
use App\FilamentExcel\Actions\Tables\TableExportBulkAction;
use App\Filament\Forms\Components\SelectBirthPlace;
use App\Filament\Forms\Components\SelectCitizenship;
use App\Filament\Forms\Components\SelectCivilStatus;
use App\Filament\Forms\Components\SelectHouseholdNumber;
use App\Filament\Forms\Components\SelectHouseNumber;
use App\Filament\Forms\Components\SelectOccupation;
use App\Filament\Forms\Components\SelectSex;
use App\Filament\Forms\Components\SelectStreet;
use App\Filament\Forms\Components\SelectZone;
use App\Filament\Imports\InhabitantImporter;
use App\Filament\Resources\HouseholdResource\RelationManagers\InhabitantsRelationManager;
use App\Filament\Resources\InhabitantResource\Pages;
use App\Filament\Resources\InhabitantResource\Pages\ListInhabitants;
// use App\Filament\Resources\InhabitantResource\RelationManagers;
use App\Filament\Tables\Columns\TextColumnHiddenByDefault;
use App\Models\Inhabitant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Column;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InhabitantResource extends Resource
{
    protected static ?string $model = Inhabitant::class;

    protected static ?string $navigationIcon = 'icon-regular-home-user';

    protected static ?string $navigationGroup = 'RBI';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(4)->schema([
                SelectHouseholdNumber::make()->hiddenOn(InhabitantsRelationManager::class),
            ]),

            Forms\Components\Grid::make(4)->schema([
                Forms\Components\TextInput::make('last_name')->required(),

                Forms\Components\TextInput::make('first_name')->required(),

                Forms\Components\TextInput::make('middle_name'),

                Forms\Components\TextInput::make('extension_name'),
            ]),

            Forms\Components\Grid::make(3)->schema([
                SelectHouseNumber::make(),

                SelectStreet::make(),

                SelectZone::make(),
            ]),

            Forms\Components\Grid::make(3)->schema([
                Forms\Components\DatePicker::make('birth_date')->label('Date of birth')->required(),

                SelectBirthPlace::make(),

                SelectSex::make()->required(),

                SelectCivilStatus::make(),

                SelectCitizenship::make(),

                SelectOccupation::make(),
            ]),

            Forms\Components\Grid::make(4)->schema([
                Forms\Components\DatePicker::make('date_accomplished'),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        $onlyVisibleAndToggleableHere = fn (Column $column) => $column
            ->visibleOn(ListInhabitants::class)
            ->toggleable(fn (Column $column) => $column->isVisible());

        $onListInhabintants = fn ($livewire) => $livewire instanceof ListInhabitants;

        return $table
            ->columns([
                TextColumnHiddenByDefault::make('last_name')->tap($onlyVisibleAndToggleableHere)->searchable(),

                TextColumnHiddenByDefault::make('first_name')->tap($onlyVisibleAndToggleableHere)->searchable(),

                TextColumnHiddenByDefault::make('middle_name')->tap($onlyVisibleAndToggleableHere)->searchable(),

                TextColumnHiddenByDefault::make('extension_name')->tap($onlyVisibleAndToggleableHere)->searchable(),

                Tables\Columns\TextColumn::make('full_name')->toggleable($onListInhabintants),

                TextColumnHiddenByDefault::make('household_number')->label('Household #')->tap($onlyVisibleAndToggleableHere),

                TextColumnHiddenByDefault::make('house_number')->label('House #'),

                TextColumnHiddenByDefault::make('street'),

                TextColumnHiddenByDefault::make('zone'),

                Tables\Columns\TextColumn::make('address')->toggleable($onListInhabintants),

                TextColumnHiddenByDefault::make('birth_date'),

                Tables\Columns\TextColumn::make('age')->toggleable($onListInhabintants),

                TextColumnHiddenByDefault::make('birth_place'),

                Tables\Columns\TextColumn::make('sex')->toggleable($onListInhabintants),

                TextColumnHiddenByDefault::make('civil_status')->toggleable($onListInhabintants),

                TextColumnHiddenByDefault::make('citizenship')->toggleable($onListInhabintants),

                TextColumnHiddenByDefault::make('occupation')->toggleable($onListInhabintants),

                TextColumnHiddenByDefault::make('date_accomplished')->tap($onlyVisibleAndToggleableHere),
            ])
            ->filters(
                [
                    Tables\Filters\TrashedFilter::make(),
                ]
            )
            ->actions(
                [
                    Tables\Actions\ViewAction::make(),

                    Tables\Actions\EditAction::make(),

                ]
            )
            ->bulkActions(
                [
                    TableExportBulkAction::make(),

                    Tables\Actions\RestoreBulkAction::make(),

                    Tables\Actions\DeleteBulkAction::make(),
                ]
            );
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
            //
        ];
    }
}
