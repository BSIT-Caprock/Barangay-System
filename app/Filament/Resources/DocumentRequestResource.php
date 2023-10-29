<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentRequestResource\Pages;
use App\Filament\Resources\DocumentRequestResource\RelationManagers;
use App\Models\Documents\DocumentRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\ToggleColumn;   
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;


class DocumentRequestResource extends Resource
{
    protected static ?string $model = DocumentRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Certificates';

    protected static ?string $recordTitleAttribute = 'latest_logbook.full_name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Document Request Logbook')
                ->description('Kindly fill up the information below.')
                ->schema([
                    DatePicker::make('date')
                    ->label('Date'),
                    // ->required(),

                    Select::make('payment_status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'overdue' => 'Overdue',
                    ]),

                    TextInput::make('address')
                    ->label('Resident Address'),
                    // ->required(),

                ])->columns(3),

                Forms\Components\Section::make('')
                ->schema([
                    TextInput::make('last_name')
                    ->label('Last Name'),
                    // ->required(),

                    TextInput::make('first_name')
                    ->label('First Name'),
                    // ->required(),

                    TextInput::make('suffix_name')
                    ->label('Extension Name'),

                ])->columns(3),

                Forms\Components\Section::make('Certificates')
                ->description('Please select the requested document.')
                ->schema([
                    Toggle::make('indigency')
                    ->onIcon('heroicon-m-check-circle')
                    ->onColor('success')
                    ->label('Indigency'),

                    Toggle::make('residency')
                    ->onIcon('heroicon-m-check-circle')
                    ->onColor('success')
                    ->label('Residency'),

                    Toggle::make('job_seekers')
                    ->onIcon('heroicon-m-check-circle')
                    ->onColor('success')
                    ->label('First Time Jobseekers'),

                    Toggle::make('clearance')
                    ->onIcon('heroicon-m-check-circle')
                    ->onColor('success')
                    ->label('Clearance'),

                    Toggle::make('death')
                    ->onIcon('heroicon-m-check-circle')
                    ->onColor('success')
                    ->label('Death'),

                    Toggle::make('good_moral')
                    ->onIcon('heroicon-m-check-circle')
                    ->onColor('success')
                    ->label('Good Moral Character'),

                    Toggle::make('solo_parent')
                    ->onIcon('heroicon-m-check-circle')
                    ->onColor('success')
                    ->label('Solo Parent'),

                    Toggle::make('large_cattle')
                    ->onIcon('heroicon-m-check-circle')
                    ->onColor('success')
                    ->label('Large Cattle'),

                    Toggle::make('open_account')
                    ->onIcon('heroicon-m-check-circle')
                    ->onColor('success')
                    ->label('Open an Account'),

                    Toggle::make('file_to_action')
                    ->onIcon('heroicon-m-check-circle')
                    ->onColor('success')
                    ->label('File to Action'),

                    Toggle::make('community_service')
                    ->onIcon('heroicon-m-check-circle')
                    ->onColor('success')
                    ->label('Community Service'),

                    Toggle::make('leyeco')
                    ->onIcon('heroicon-m-check-circle')
                    ->onColor('success')
                    ->label('Leyeco Connection / Installation'),

                    Toggle::make('mcwd')
                    ->onIcon('heroicon-m-check-circle')
                    ->onColor('success')
                    ->label('MCWD (Metro Carigara Water District'),

                ])->columns(3),

                Forms\Components\Section::make('')
                ->schema([
                    DatePicker::make('date_applied')
                    ->label('Date Applied'),
                    // ->required(),

                    DatePicker::make('date_release')
                    ->label('Date Release'),
                    // ->required(),

                    DatePicker::make('date_recieved')
                    ->label('Date Received'),
                    // ->required(),

                    FileUpload::make('signature')
                        ->label('Signature')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios([
                            '1:1',
                        ])
                        ->preserveFilenames()
                        ->openable()
                        ->downloadable()
                        ->previewable(false)
                        // ->required(),

                ])->columns(2),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')
                    ->label('Date')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('address')
                    ->label('Resident Address')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('Certificates')
                    ->label('Date')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                ToggleColumn::make('indegency')
                    ->label('Indigency')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListDocumentRequests::route('/'),
            'create' => Pages\CreateDocumentRequest::route('/create'),
            'edit' => Pages\EditDocumentRequest::route('/{record}/edit'),
        ];
    }    
}
