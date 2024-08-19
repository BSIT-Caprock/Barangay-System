<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RbiHouseholdResource\Pages;
use App\Filament\Resources\RbiHouseholdResource\RelationManagers;
use App\Filament\Widgets\ResourcePageTableWidget;
use App\Models\RbiHousehold;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Component;

class RbiHouseholdResource extends Resource
{
    protected static ?string $model = RbiHousehold::class;

    protected static ?string $modelLabel = 'household';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'RBI';

    public static function getNavigationLabel(): string
    {
        if (request()->is('rbi-*')) {
            return 'RBI - Households';
        } else {
            return 'RBI';
        }
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('number')
                    ->required()
                    ->afterStateUpdated(function (Component $livewire, Get $get) {
                        if ($livewire instanceof Pages\CreateRbiHousehold) {
                            $livewire->dispatch(ResourcePageTableWidget::WHERE, [['number', 'like', "%{$get('number')}%"]]);
                        }
                    })
                    ->live(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
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
            'index' => Pages\ListRbiHouseholds::route('/'),
            'create' => Pages\CreateRbiHousehold::route('/create'),
            'edit' => Pages\EditRbiHousehold::route('/{record}/edit'),
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
