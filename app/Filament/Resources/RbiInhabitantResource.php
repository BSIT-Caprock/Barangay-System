<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RbiInhabitantResource\Pages;
use App\Filament\Resources\RbiInhabitantResource\RelationManagers;
use App\Models\RbiInhabitant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RbiInhabitantResource extends Resource
{
    protected static ?string $model = RbiInhabitant::class;

    protected static ?string $modelLabel = 'inhabitant';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('last_name')
                    ->afterStateUpdated(function ($livewire, $operation, $state): void {
                        if ($operation == 'create') {
                            static::setTableWidget($livewire, 'last_name', 'like', "%{$state}%");
                        }
                    })
                    ->live(),
                Forms\Components\TextInput::make('first_name')
                    ->afterStateUpdated(function ($livewire, $operation, $state): void {
                        if ($operation == 'create') {
                            static::setTableWidget($livewire, 'first_name', 'like', "%{$state}%");
                        }
                    })
                    ->live(),
                Forms\Components\TextInput::make('middle_name')
                    ->afterStateUpdated(function ($livewire, $operation, $state): void {
                        if ($operation == 'create') {
                            static::setTableWidget($livewire, 'middle_name', 'like', "%{$state}%");
                        }
                    })
                    ->live(),
                Forms\Components\TextInput::make('extension_name')
                    ->afterStateUpdated(function ($livewire, $operation, $state): void {
                        if ($operation == 'create') {
                            static::setTableWidget($livewire, 'extension_name', 'like', "%{$state}%");
                        }
                    })
                    ->live(),
                Forms\Components\TextInput::make('house_number'),
                Forms\Components\TextInput::make('street_name'),
                Forms\Components\TextInput::make('zone_name'),
                Forms\Components\TextInput::make('birthplace')
                    ->afterStateUpdated(function ($livewire, $operation, $state): void {
                        if ($operation == 'create') {
                            static::setTableWidget($livewire, 'birthplace', 'like', "%{$state}%");
                        }
                    })
                    ->live(),
                Forms\Components\DatePicker::make('birthdate')
                    ->maxDate(today())
                    ->afterStateUpdated(function ($livewire, $operation, $state): void {
                        if ($operation == 'create') {
                            static::setTableWidget($livewire, 'birthdate', '=', $state);
                        }
                    })
                    ->live(),
                Forms\Components\Select::make('sex')
                    ->options([
                        'M' => 'Male',
                        'F' => 'Female',
                    ])
                    ->afterStateUpdated(function ($livewire, $operation, $state): void {
                        if ($operation == 'create') {
                            static::setTableWidget($livewire, 'sex', '=', $state);
                        }
                    })
                    ->live(),
                Forms\Components\Select::make('civil_status')
                    ->options([
                        'S' => 'Single',
                        'M' => 'Married',
                        'W' => 'Widow/Widower',
                        'SE' => 'Separated',
                    ]),
                Forms\Components\TextInput::make('citizenship'),
                Forms\Components\TextInput::make('occupation'),
                Forms\Components\Select::make('rbi_household_id')
                    ->relationship('household', 'number')
                    ->searchable()
                    ->preload(),
            ]);
    }

    public static function setTableWidget($livewire, $column, $operator = null, $value = null, $boolean = 'and')
    {
        if (empty($value)) {
            $livewire->removeTableWidgetWhereClause($column);
            return;
        }
        $livewire->setTableWidgetWhereClause($column, $operator, $value, $boolean);
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
                Tables\Columns\TextColumn::make('extension_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('house_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('street_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('zone_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('birthplace')
                    ->searchable(),
                Tables\Columns\TextColumn::make('birthdate')
                    ->searchable()
                    ->date(),
                Tables\Columns\TextColumn::make('sex')
                    ->searchable()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'M' => 'Male',
                        'F' => 'Female',
                    }),
                Tables\Columns\TextColumn::make('civil_status')
                    ->searchable()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'S' => 'Single',
                        'M' => 'Married',
                        'W' => 'Widow/Widower',
                        'SE' => 'Separated',
                    }),
                Tables\Columns\TextColumn::make('citizenship')
                    ->searchable(),
                Tables\Columns\TextColumn::make('occupation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('household.number')
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

    public static function getNavigationParentItem(): ?string
    {
        return RbiHouseholdResource::getNavigationLabel();
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
            'index' => Pages\ListRbiInhabitants::route('/'),
            'create' => Pages\CreateRbiInhabitant::route('/create'),
            'edit' => Pages\EditRbiInhabitant::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getGlobalSearchResultTitle(Model $record): string|Htmlable
    {
        $birthdate = $record->birthdate?->format('F j, Y');
        return "{$record->first_name} {$record->middle_name} {$record->last_name} {$record->extension_name} " . ($birthdate ? "(born {$birthdate})" : '');
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['last_name', 'first_name', 'middle_name', 'extension_name'];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->where('deleted_at', null);
    }

    public static function getWidgets(): array
    {
        return [
            RbiInhabitantResource\Widgets\ExistingInhabitants::class,
        ];
    }
}
