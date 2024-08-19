<?php

namespace App\Filament\Resources\RbiInhabitantResource\Pages;

use App\Filament\Resources\RbiInhabitantResource;
use App\Filament\Widgets\ResourcePageTableWidget;
use Filament\Actions\Action;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Pages\CreateRecord;
use Livewire\Component;

class CreateRbiInhabitant extends CreateRecord
{
    /** @var class-string<\Filament\Resources\Resource> */
    protected static string $resource = RbiInhabitantResource::class;
    
    public bool $isContinued = false;

    public function form(Form $form): Form
    {
        $fields = $form->getFlatFields(withHidden: true);

        $afterStateUpdated = function () {
            $this->dispatch(ResourcePageTableWidget::WHERE, $this->getTableWhereClauses());
        };

        $fields['last_name']
            ->afterStateUpdated($afterStateUpdated)
            ->live();
        $fields['first_name']
            ->afterStateUpdated($afterStateUpdated)
            ->live();
        $fields['middle_name']
            ->afterStateUpdated($afterStateUpdated)
            ->live();
        $fields['extension_name']
            ->afterStateUpdated($afterStateUpdated)
            ->live();
        $fields['birthplace']
            ->afterStateUpdated($afterStateUpdated)
            ->live();
        $fields['birthdate']
            ->afterStateUpdated($afterStateUpdated)
            ->live();
        $fields['sex']
            ->afterStateUpdated($afterStateUpdated)
            ->live();

        $fields['house_number']
            ->visible(fn () => $this->isContinued);
        $fields['street_name']
            ->visible(fn () => $this->isContinued);
        $fields['zone_name']
            ->visible(fn () => $this->isContinued);
        $fields['civil_status']
            ->visible(fn () => $this->isContinued);
        $fields['citizenship']
            ->visible(fn () => $this->isContinued);
        $fields['occupation']
            ->visible(fn () => $this->isContinued);
        $fields['rbi_household_id']
            ->visible(fn () => $this->isContinued);

        return $form;
    }

    protected function getCreateFormAction(): Action
    {
        return Action::make('create')
            ->label(fn () => $this->isContinued ? 'Create': 'Continue')
            ->requiresConfirmation(fn (): bool => static::$resource::getEloquentQuery()
                ->where($this->getTableWhereClauses())->count() > 0
            )
            ->modalDescription('Are you sure you want to continue? (There are records similar to your inputs / You have not entered any information)')
            ->action(function () {
                $this->isContinued = true;
            });
    }

    protected function getFooterWidgets(): array
    {
        $widgets = [];
        if (!$this->isContinued) {
            $widgets[] = $this->getResourcePageTableWidget();
        }
        return $widgets;
    }

    protected function getResourcePageTableWidget()
    {
        return ResourcePageTableWidget::makeWith($this->getResource(), initialWhere: []);
    }

    protected function getTableWhereClauses()
    {
        $where = [];
        $data = $this->data;
        if (filled($data['last_name'])) {
            $where[] = ['last_name', 'like', "%{$data['last_name']}%"];
            $where[] = ['middle_name', 'like', "%{$data['last_name']}%", 'or'];
        }
        if (filled($data['first_name'])) {
            $where[] = ['first_name', 'like', "%{$data['first_name']}%"];
        }
        if (filled($data['middle_name'])) {
            $where[] = ['middle_name', 'like', "%{$data['last_name']}%"];
            $where[] = ['last_name', 'like', "%{$data['last_name']}%", 'or'];
        }
        if (filled($data['extension_name'])) {
            $where[] = ['extension_name', 'like', "%{$data['extension_name']}%"];
        }
        if (filled($data['birthplace'])) {
            $where[] = ['birthplace', 'like', "%{$data['birthplace']}%"];
        }
        if (filled($data['birthdate'])) {
            $where[] = ['birthdate', '=', $data['birthdate']];
        }
        if (filled($data['sex'])) {
            $where[] = ['sex', '=', $data['sex']];
        }
        return $where;
    }
}
