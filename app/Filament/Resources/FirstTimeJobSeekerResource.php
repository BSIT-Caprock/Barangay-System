<?php

namespace App\Filament\Resources;

use App\FilamentExcel\Actions\Tables\TableExportAction;
use App\FilamentExcel\Actions\Tables\TableExportBulkAction;
use App\Filament\Forms\Components\SelectCourse;
use App\Filament\Forms\Components\SelectEducationalLevel;
use App\Filament\Forms\Components\SelectSex;
use App\Filament\Resources\FirstTimeJobSeekerResource\Pages;
use App\Models\FirstTimeJobSeeker;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FirstTimeJobSeekerResource extends Resource
{
    protected static ?string $model = FirstTimeJobSeeker::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'DILG';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('last_name')->required(),
                Forms\Components\TextInput::make('first_name')->required(),
                Forms\Components\TextInput::make('middle_name')->required(),
                Forms\Components\DatePicker::make('birth_date')->required(),
                SelectSex::make()->required(),
                SelectEducationalLevel::make()->required(),
                SelectCourse::make(),
                Forms\Components\DatePicker::make('date_applied')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('month_year')->label('Month'),
                Tables\Columns\TextColumn::make('last_name'),
                Tables\Columns\TextColumn::make('first_name'),
                Tables\Columns\TextColumn::make('middle_name'),
                Tables\Columns\TextColumn::make('age'),
                Tables\Columns\TextColumn::make('birth_date')->label('Date of birth')->dateTime('M d, Y'),
                Tables\Columns\TextColumn::make('sex'),
                Tables\Columns\TextColumn::make('educational_level'),
                Tables\Columns\TextColumn::make('course'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->url(null),
                Tables\Actions\EditAction::make()->url(null),

            ])
            ->bulkActions([
                TableExportBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
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
            'index' => Pages\ListFirstTimeJobSeekers::route('/'),
            'create' => Pages\CreateFirstTimeJobSeeker::route('/create'),
            'edit' => Pages\EditFirstTimeJobSeeker::route('/{record}/edit'),
        ];
    }
}
