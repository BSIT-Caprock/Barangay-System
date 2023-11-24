<?php

namespace App\Filament\Resources\HouseholdResource\RelationManagers;

use App\Filament\Resources\InhabitantResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class InhabitantsRelationManager extends RelationManager
{
    protected static string $relationship = 'inhabitants';

    public function form(Form $form): Form
    {
        return InhabitantResource::form($form);
        // return $form
        //     ->schema([
        //         Forms\Components\TextInput::make('full_name')
        //             ->required()
        //             ->maxLength(255),
        //     ]);
    }

    public function table(Table $table): Table
    {
        return InhabitantResource::table($table);
        // return $table
        //     ->recordTitleAttribute('full_name')
        //     ->columns([
        //         Tables\Columns\TextColumn::make('full_name'),
        //     ])
        //     ->filters([
        //         //
        //     ])
        //     ->headerActions([
        //         Tables\Actions\CreateAction::make(),
        //     ])
        //     ->actions([
        //         Tables\Actions\EditAction::make(),
        //         Tables\Actions\DeleteAction::make(),
        //     ])
        //     ->bulkActions([
        //         Tables\Actions\BulkActionGroup::make([
        //             Tables\Actions\DeleteBulkAction::make(),
        //         ]),
        //     ]);
    }
}
