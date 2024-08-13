<?php

namespace App\Filament\Resources\RbiHouseholdResource\RelationManagers;

use App\Filament\Resources\RbiInhabitantResource;
use App\Models\RbiHousehold;
use App\Models\RbiInhabitant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InhabitantsRelationManager extends RelationManager
{
    protected static string $relationship = 'inhabitants';

    public function form(Form $form): Form
    {
        return RbiInhabitantResource::form($form);
    }

    public function table(Table $table): Table
    {
        return RbiInhabitantResource::table($table)
            ->modelLabel(RbiInhabitantResource::getModelLabel())
            ->recordTitle(function (RbiInhabitant $record) {
                $recordTitle = "{$record->first_name} {$record->middle_name} {$record->last_name} {$record->extension_name}";
                if ($record->birthdate) {
                    $recordTitle .= "(born {$record->birthdate->format('F j, Y')})";
                }
                return $recordTitle;
            })
            ->inverseRelationship('household')
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AssociateAction::make()
                    ->recordSelectSearchColumns(['last_name', 'first_name', 'middle_name', 'extension_name']),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DissociateAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DissociateBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
