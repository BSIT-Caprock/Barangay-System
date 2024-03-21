<?php

namespace App\Filament\Resources\FamilyResource\RelationManagers;

use App\FilamentExcel\Actions\Tables\TableExportAction;
use App\FilamentExcel\Actions\Tables\TableExportBulkAction;
use App\Models\Inhabitant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MembersRelationManager extends RelationManager
{
    protected static string $relationship = 'members';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(1)->schema(
                    [
                        Forms\Components\Select::make('inhabitant_id')
                            ->label('Name')
                            ->searchable()
                            ->searchPrompt('<Name> or <Last name, First name>')
                            ->getSearchResultsUsing(fn (string $search): array => Inhabitant::whereFullName($search)
                                ->limit(10)
                                ->get()
                                ->pluck('full_name', 'id')
                                ->toArray())
                            ->getOptionLabelUsing(fn ($value) => Inhabitant::find($value)->full_name),
                        // ->getOptionLabelFromRecordUsing(fn (Inhabitant $record) => $record->full_name),
                    ]
                ),
                Forms\Components\Grid::make(4)->schema(
                    [
                        Forms\Components\Select::make('is_lgbtq')->label('LGBTQ+')->boolean(),

                        Forms\Components\Select::make('has_disability')->label('PWD')->boolean()
                            ->hintIcon('heroicon-m-question-mark-circle', 'Person with disabilities'),

                        Forms\Components\Select::make('has_disease')->boolean(),

                        Forms\Components\Select::make('is_pregnant')->label('Pregnant')->boolean(),
                    ]
                ),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns(
                [
                    Tables\Columns\TextColumn::make('name'),

                    Tables\Columns\TextColumn::make('is_lgbtq')->label('Is LGBTQ+')
                        ->formatStateUsing(fn (mixed $state) => match ($state) {
                            1 => 'Yes',
                            0 => 'No',
                        }),

                    Tables\Columns\TextColumn::make('has_disability')->label('Has disability')
                        ->formatStateUsing(fn (mixed $state) => match ($state) {
                            1 => 'Yes',
                            0 => 'No',
                        }),

                    Tables\Columns\TextColumn::make('has_disease')->label('Has disease')
                        ->formatStateUsing(fn (mixed $state) => match ($state) {
                            1 => 'Yes',
                            0 => 'No',
                        }),

                    Tables\Columns\TextColumn::make('is_pregnant')->label('Is pregnant')
                        ->formatStateUsing(fn (mixed $state) => match ($state) {
                            1 => 'Yes',
                            0 => 'No',
                        }),
                ]
            )
            ->filters(
                [
                    Tables\Filters\TrashedFilter::make(),
                ]
            )
            ->headerActions(
                [
                    TableExportAction::make(),

                    Tables\Actions\CreateAction::make(),
                ]
            )
            ->actions(
                [
                    Tables\Actions\EditAction::make()->iconButton(),
                ],
                Tables\Enums\ActionsPosition::BeforeColumns
            )
            ->bulkActions(
                [
                    TableExportBulkAction::make(),

                    Tables\Actions\RestoreBulkAction::make(),

                    Tables\Actions\DeleteBulkAction::make(),
                ]
            )
            ->modifyQueryUsing(
                fn (Builder $query) => $query->withoutGlobalScopes([SoftDeletingScope::class])
            );
    }
}
