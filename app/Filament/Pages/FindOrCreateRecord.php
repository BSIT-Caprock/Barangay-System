<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ResourcePageTableWidget;
use Filament\Actions\Action;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class FindOrCreateRecord extends CreateRecord
{
    /** @var class-string<\Filament\Resources\Resource> */
    protected static string $resource;

    protected static bool $isDiscovered = false;

    protected static array $identityFields = [];

    public bool $isContinued = false;

    public function form(Form $form): Form
    {
        $fields = $form->getFlatFields(withHidden: true);
        foreach ($fields as $name => $field) {
            if (in_array($name, $this::$identityFields)) {
                $field
                    ->afterStateUpdated(function () {
                        $this->dispatch(ResourcePageTableWidget::WHERE, $this->getTableWhereClauses());
                    })
                    ->live();
            } else {
                $field->visible(fn () => $this->isContinued);
            }
        }

        return $form;
    }

    protected function getTableWhereClauses()
    {
        $where = [];
        $data = $this->data;
        foreach ($this::$identityFields as $field) {
            $clauses = $this->getWhereClauses($field, $data[$field]);
            if (is_null($clauses)) {
                continue;
            }
            array_push($where, ...$clauses);
        }
        return $where;
    }

    protected function getWhereClauses(string $fieldName, mixed $value)
    {
        return match ($fieldName) {
            default => null,
        };
    }

    protected function getCreateFormAction(): Action
    {
        return Action::make('create')
            ->label(fn () => $this->isContinued ? 'Create': 'Continue')
            ->action(function () {
                if ($this->isContinued) {
                    $this->create();
                } else {
                    $this->isContinued = true;
                }
            });
    }

    protected function getFooterWidgets(): array
    {
        $widgets = [];
        if (! $this->isContinued) {
            $widgets[] = $this->getResourcePageTableWidget();
        }

        return $widgets;
    }

    protected function getResourcePageTableWidget()
    {
        return ResourcePageTableWidget::makeWith($this->getResource(), initialWhere: []);
    }
}
