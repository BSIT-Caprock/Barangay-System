<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class Settings extends Page implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.settings';

    public function mount(): void
    {
        $setting = Setting::query()->first();
        if ($setting) {
            $this->form->fill($setting->attributesToArray());
        } else {
            $this->form->fill();
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
                Forms\Components\TextInput::make('barangay_name'),
                Forms\Components\FileUpload::make('logo')
                    ->disk('local')
                    ->downloadable()
                    ->acceptedFileTypes(['image/*', '*.png', '*.jpg', '*.jpeg'])
                    ->getUploadedFileNameForStorageUsing(fn (TemporaryUploadedFile $file) => 'logo.'.$file->extension())
                    ->imageEditor()
                    ->imageEditorAspectRatios([null, '1:1']),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $setting = Setting::query()->first();
        $data = $this->form->getState();

        if ($setting) {
            $setting->update($data);
        } else {
            Setting::create($data);
        }

        Notification::make()
            ->success()
            ->title(__('filament-panels::resources/pages/edit-record.notifications.saved.title'))
            ->send();
    }
}
