<?php

namespace App\Filament\Resources\HouseholdResource\RelationManagers;

use App\Filament\Resources\InhabitantResource;
use App\Models\Inhabitant;
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
        return InhabitantResource::table($table)
            ->inverseRelationship('household')
            ->recordTitle(fn (Inhabitant $record) => $record->full_name)
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AssociateAction::make()
                    ->recordSelectSearchColumns(['last_name', 'first_name', 'middle_name']),
            ]);
    }
}
