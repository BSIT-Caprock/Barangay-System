<?php

namespace App\Filament\Resources;

use App\FilamentExcel\Actions\Tables\TableExportBulkAction;
use App\Filament\Resources\FamilyResource\Pages;
use App\Models\Family;
use App\Models\Street;
use App\Models\Zone;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FamilyResource extends Resource
{
    protected static ?string $model = Family::class;

    protected static ?string $navigationIcon = 'icon-pedestrian-family';

    protected static ?string $navigationGroup = 'RBI';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                [
                    Forms\Components\MorphToSelect::make('location')->types(
                        [
                            Forms\Components\MorphToSelect\Type::make(Zone::class)->titleAttribute('name'),

                            Forms\Components\MorphToSelect\Type::make(Street::class)->titleAttribute('name'),
                        ]
                    )->columns(2),

                    Forms\Components\Select::make('head_id')
                        ->label('Family head')
                        ->native(false)
                        ->options(
                            fn (?Family $record): array => $record?->members->pluck('name', 'id')->toArray() ?? []
                        ),
                ]
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(
                [
                    Tables\Columns\TextColumn::make('location'),

                    Tables\Columns\TextColumn::make('members_count')->label('Total members')->counts('members'),
                ]
            )
            ->filters(
                [
                    Tables\Filters\TrashedFilter::make(),
                ]
            )
            ->actions(
                [
                    Tables\Actions\ViewAction::make()->iconButton()->color('primary'),

                    Tables\Actions\EditAction::make()->iconButton()->color('primary'),
                ],
                Tables\Enums\ActionsPosition::BeforeColumns
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
        return parent::getEloquentQuery()->withoutGlobalScope(SoftDeletingScope::class);
    }

    public static function getRelations(): array
    {
        return [
            FamilyResource\RelationManagers\MembersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFamilies::route('/'),
            'create' => Pages\CreateFamily::route('/create'),
            'edit' => Pages\EditFamily::route('/{record}/edit'),
        ];
    }
}
