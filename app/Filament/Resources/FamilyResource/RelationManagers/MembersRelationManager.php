<?php

namespace App\Filament\Resources\FamilyResource\RelationManagers;

use App\Filament\Actions\FilamentExcel\TableExportBulkAction;
use App\Filament\Forms\SelectInhabitant;
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
                Forms\Components\Grid::make(4)->schema([
                    SelectInhabitant::make(),
                ]),
                Forms\Components\Grid::make(4)->schema([
                    Forms\Components\Select::make('is_lgbtq')->label('LGBTQ+')->boolean(),
                    Forms\Components\Select::make('has_disability')->label('PWD')->boolean()
                        ->hintIcon('heroicon-m-question-mark-circle', 'Person with disabilities'),
                    Forms\Components\Select::make('has_disease')->boolean(),
                    Forms\Components\Select::make('is_pregnant')->label('Pregnant')->boolean(),
                ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\IconColumn::make('is_lgbtq')->label('LGBTQ+')->boolean(),
                Tables\Columns\IconColumn::make('has_disability')->label('Disability')->boolean(),
                Tables\Columns\IconColumn::make('has_disease')->label('Disease')->boolean(),
                Tables\Columns\IconColumn::make('is_pregnant')->label('Pregnant')->boolean(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                TableExportBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make(),
            ])->modifyQueryUsing(fn (Builder $query) => $query->withoutGlobalScopes([SoftDeletingScope::class]));
    }
}
