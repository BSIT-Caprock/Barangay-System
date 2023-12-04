<?php

namespace App\Filament\Resources;

use App\Filament\Actions\FilamentExcel\TableExportAction;
use App\Filament\Actions\FilamentExcel\TableExportBulkAction;
use App\Filament\Forms\SelectBarangay;
use App\Filament\Resources\HouseholdResource\Pages;
use App\Filament\Resources\HouseholdResource\RelationManagers;
use App\Filament\Resources\HouseholdResource\Widgets\HouseholdCount;
use App\Models\Household;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HouseholdResource extends Resource
{
    protected static ?string $model = Household::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    protected static ?string $navigationGroup = 'RBI';
    
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                SelectBarangay::make()->required()->hidden((bool) auth()->user()->barangay),

                Forms\Components\TextInput::make('number')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('barangay')
                    ->hidden((bool) auth()->user()->barangay)
                    ->toggleable(!auth()->user()->barangay),

                Tables\Columns\TextColumn::make('number'),

                Tables\Columns\TextColumn::make('inhabitants_count')->label('Total inhabitants')->counts('inhabitants'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->headerActions([
                TableExportAction::make(),
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                TableExportBulkAction::make(),
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
            RelationManagers\InhabitantsRelationManager::class,
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
