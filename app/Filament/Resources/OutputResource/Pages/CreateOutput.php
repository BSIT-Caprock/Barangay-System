<?php

namespace App\Filament\Resources\OutputResource\Pages;

use App\Filament\Helper;
use App\Filament\Resources\OutputResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Arr;

class CreateOutput extends CreateRecord
{
    protected static string $resource = OutputResource::class;
}
