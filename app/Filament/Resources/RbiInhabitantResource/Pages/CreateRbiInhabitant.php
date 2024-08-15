<?php

namespace App\Filament\Resources\RbiInhabitantResource\Pages;

use App\Concerns\Filament\HasTableWidget;
use App\Filament\Resources\RbiInhabitantResource;
use App\Filament\Widgets\ResourcePageTableWidget;
use Filament\Actions;
use Filament\Forms\Get;
use Filament\Resources\Pages\CreateRecord;
use Livewire\Component;

class CreateRbiInhabitant extends CreateRecord
{
    protected static string $resource = RbiInhabitantResource::class;

    protected function getFooterWidgets(): array
    {
        return [
            ResourcePageTableWidget::makeWith($this->getResource(), initialWhere: []),
        ];
    }

    public static function dispatchCreatePageTableWidget(Component $livewire, Get $get)
    {
        if (!($livewire instanceof self)) {
            return;
        }
        $where = [];

        if (filled($get('last_name'))) {
            $where[] = ['last_name', 'like', "%{$get('last_name')}%"];
            $where[] = ['middle_name', 'like', "%{$get('last_name')}%", 'or'];
        }

        if (filled($get('first_name'))) {
            $where[] = ['first_name', 'like', "%{$get('first_name')}%"];
        }
        
        if (filled($get('middle_name'))) {
            $where[] = ['middle_name', 'like', "%{$get('last_name')}%"];
            $where[] = ['last_name', 'like', "%{$get('last_name')}%", 'or'];
        }
        
        if (filled($get('extension_name'))) {
            $where[] = ['extension_name', 'like', "%{$get('extension_name')}%"];
        }
        
        if (filled($get('birthplace'))) {
            $where[] = ['birthplace', 'like', "%{$get('birthplace')}%"];
        }
        
        if (filled($get('birthdate'))) {
            $where[] = ['birthdate', '=', $get('birthdate')];
        }
        
        if (filled($get('sex'))) {
            $where[] = ['sex', '=', $get('sex')];
        }

        $livewire->dispatch(ResourcePageTableWidget::WHERE, $where);
    }
}
