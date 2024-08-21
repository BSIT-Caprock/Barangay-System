<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrpwdPersonWithDisabilityResource\Pages;
use App\Filament\Resources\PrpwdPersonWithDisabilityResource\RelationManagers;
use App\Models\PrpwdPersonWithDisability;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PrpwdPersonWithDisabilityResource extends Resource
{
    protected static ?string $model = PrpwdPersonWithDisability::class;

    protected static ?string $modelLabel = 'person with disability';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $pluralModelLabel = 'persons with disabilities';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(4)
            ->schema([
                Forms\Components\TextInput::make('last_name')
                    ->required(),
                Forms\Components\TextInput::make('first_name')
                    ->required(),
                Forms\Components\TextInput::make('middle_name'),
                Forms\Components\TextInput::make('suffix'),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->columnSpan(2),
                Forms\Components\Select::make('disability_type')
                    ->required()
                    ->options([
                        'Deaf or Hard of Hearing' => 'Deaf or Hard of Hearing',
                        'Intellectual Disability' => 'Intellectual Disability',
                        'Learning Disability' => 'Learning Disability',
                        'Mental Disability' => 'Mental Disability',
                        'Physical Disability (Orthopedic)' => 'Physical Disability (Orthopedic)',
                        'Psychosocial Disability' => 'Psychosocial Disability',
                        'Speech and Language Impairment' => 'Speech and Language Impairment',
                        'Visual Disability' => 'Visual Disability',
                        'Cancer (RA11215)' => 'Cancer (RA11215)',
                        'Rare Disease (RA10747)' => 'Rare Disease (RA10747)',
                    ]),
                Forms\Components\Select::make('disability_cause')
                    ->required()
                    ->options([
                        'Congenital/Inborn' => [
                            'Congenital/Inborn - Autism' => 'Autism',
                            'Congenital/Inborn - ADHD' => 'ADHD',
                            'Congenital/Inborn - Cerebral Palsy' => 'Cerebral Palsy',
                            'Congenital/Inborn - Down Syndrome' => 'Down Syndrome',
                        ],
                        'Acquired' => [
                            'Acquired - Chronic Illness' => 'Chronic Illness',
                            'Acquired - Cerebral Palsy' => 'Cerebral Palsy',
                            'Acquired - Injury' => 'Injury',
                        ]
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('middle_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('suffix')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('disability_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('disability_cause')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrpwdPersonWithDisabilities::route('/'),
            'create' => Pages\CreatePrpwdPersonWithDisability::route('/create'),
            'edit' => Pages\EditPrpwdPersonWithDisability::route('/{record}/edit'),
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
