<?php

namespace App\Filament\Resources;

use App\Filament\Actions\FilamentExcel\TableExportAction;
use App\Filament\Actions\FilamentExcel\TableExportBulkAction;
use App\Filament\Actions\GenerateDocxAction;
use App\Filament\Resources\ResidencyCertificateResource\Pages;
use App\Models\ResidencyCertificate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class ResidencyCertificateResource extends Resource
{
    protected static ?string $model = ResidencyCertificate::class;

    protected static ?string $navigationGroup = 'Certificates';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                [
                    Forms\Components\TextInput::make('resident_name')->required(),

                    Forms\Components\TextInput::make('resident_age')->required(),

                    Forms\Components\TextInput::make('resident_citizenship')->required(),

                    Forms\Components\TextInput::make('resident_civil_status')->required(),

                    Forms\Components\TextInput::make('punong_barangay')->required(),

                    Forms\Components\DatePicker::make('date_issued')->required(),

                    Forms\Components\TextInput::make('amount_paid')->required(),

                    Forms\Components\TextInput::make('dst')->label('DST')->required(),

                    Forms\Components\TextInput::make('receipt_number')->label('O.R. #')->required(),
                ]
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(
                [
                    Tables\Columns\TextColumn::make('receipt_number')->label('O.R. #'),

                    Tables\Columns\TextColumn::make('resident_name'),

                    Tables\Columns\TextColumn::make('resident_age')->toggleable()->toggledHiddenByDefault(),

                    Tables\Columns\TextColumn::make('resident_civil_status')->toggleable()->toggledHiddenByDefault(),

                    Tables\Columns\TextColumn::make('amount_paid'),

                    Tables\Columns\TextColumn::make('dst')->label('DST'),

                    Tables\Columns\TextColumn::make('date_issued')->date('M d, Y'),
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
                    Tables\Actions\EditAction::make()->iconButton()->color('primary'),

                    GenerateDocxAction::make('download_certificate')
                        ->iconButton()
                        ->processTemplate(
                            // template
                            fn (ResidencyCertificate $record) => Storage::path($record->template_path),
                            // data
                            fn (ResidencyCertificate $record) => [
                                'resident_name' => $record->resident_name,
                                'resident_age' => $record->resident_age,
                                'resident_citizenship' => $record->resident_citizenship,
                                'resident_civil_status' => $record->resident_civil_status,
                                'date_issued_day_ord' => $record->date_issued->isoFormat('Do'),
                                'date_issued_month' => $record->date_issued->isoFormat('MMMM'),
                                'date_issued_year' => $record->date_issued->isoFormat('YYYY'),
                                'punong_barangay' => $record->punong_barangay,
                                'amount_paid' => $record->amount_paid,
                                'dst' => $record->dst,
                                'receipt_number' => $record->receipt_number,
                                'date_issued' => $record->date_issued->isoFormat('MMMM D, YYYY'),
                            ],
                            // identifier
                            fn (ResidencyCertificate $record) => \Illuminate\Support\Str::slug($record->resident_name),
                        ),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageResidencyCertificates::route('/'),
        ];
    }
}
