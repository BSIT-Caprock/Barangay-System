<?php

namespace App\Filament\Resources;

use App\Filament\Actions\FilamentExcel\TableExportAction;
use App\Filament\Actions\FilamentExcel\TableExportBulkAction;
use App\Filament\Forms\SelectBarangay;
use App\Filament\Resources\PersonWithDisabilityResource\Pages;
use App\Filament\Tables\BarangayColumn;
use App\Models\PersonWithDisability;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PersonWithDisabilityResource extends Resource
{
    protected static ?string $model = PersonWithDisability::class;

    protected static ?string $slug = 'persons-with-disabilities';

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    protected static ?string $navigationGroup = 'MSWDO';

    protected static ?string $pluralModelLabel = 'Persons with Disabilities';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                SelectBarangay::make()->required()->hidden((bool) auth()->user()->barangay),

                Forms\Components\Select::make('disability_id')
                    ->label('Disability')
                    ->required()
                    ->relationship('disability', 'name'),

                Forms\Components\Select::make('disability_cause_id')
                    ->label('Cause of disability')
                    ->required()
                    ->relationship('disability_cause', 'name'),

                Forms\Components\TextInput::make('last_name')
                    ->required(),

                Forms\Components\TextInput::make('first_name')
                    ->required(),

                Forms\Components\TextInput::make('middle_name'),

                Forms\Components\TextInput::make('extension_name'),

                Forms\Components\TextInput::make('address')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                BarangayColumn::make()
                    ->sortable(),

                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('middle_name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('extension_name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('address')
                    ->searchable(),

                Tables\Columns\TextColumn::make('disability')
                    ->sortable(),

                Tables\Columns\TextColumn::make('disability_cause')
                    ->label('Cause')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->headerActions([
                TableExportAction::make(),
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->iconButton()->color('primary'),

                Tables\Actions\EditAction::make()->iconButton()->color('primary'),

            ], Tables\Enums\ActionsPosition::BeforeColumns)
            ->bulkActions([
                TableExportBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPersonWithDisabilities::route('/'),
            'create' => Pages\CreatePersonWithDisability::route('/create'),
            'edit' => Pages\EditPersonWithDisability::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
