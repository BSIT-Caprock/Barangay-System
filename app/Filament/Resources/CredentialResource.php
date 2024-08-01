<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CredentialResource\Pages;
use App\Filament\Resources\CredentialResource\RelationManagers;
use App\Models\Credential;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CredentialResource extends Resource
{
    protected static ?string $model = Credential::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('receipt_number')
                    ->required(),
                Forms\Components\TextInput::make('receipt_amount')
                    ->required()
                    ->numeric()
                    ->prefix('₱')
                    ->formatStateUsing(fn (mixed $state, string $operation) => $operation === 'edit' ? number_format($state, 2) : $state)
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(','),
                Forms\Components\TextInput::make('recipient')
                    ->required(),
                Forms\Components\DatePicker::make('date_issued')
                    ->required()
                    ->hintAction(
                            Forms\Components\Actions\Action::make('dateIssuedToday')
                                ->label('Today')
                                ->action(function (Forms\Set $set) {
                                    $set('date_issued', today());
                                })
                    ),
                Forms\Components\Select::make('credential_template_id')
                    ->relationship('template', 'title')
                    ->searchable()
                    ->preload(),
                Forms\Components\KeyValue::make('credential_template_data')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('receipt_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('receipt_amount')
                    ->numeric()
                    ->money(),
                Tables\Columns\TextColumn::make('recipient')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_issued')
                    ->date(),
                Tables\Columns\TextColumn::make('template.title'),
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
                Tables\Filters\SelectFilter::make('credential_template_id')
                    ->relationship('template', 'title')
                    ->searchable()
                    ->preload()
                    ->columnSpan(2),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->filtersLayout(Tables\Enums\FiltersLayout::AboveContent)
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
            'index' => Pages\ListCredentials::route('/'),
            'create' => Pages\CreateCredential::route('/create'),
            'edit' => Pages\EditCredential::route('/{record}/edit'),
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
