<?php

namespace App\Bindings\Filament\Tables\Columns;

use Closure;

class TextColumn extends \Filament\Tables\Columns\TextColumn
{
    public function date(?string $format = null, ?string $timezone = null): static
    {
        return parent::date($format ?? 'F j, Y', $timezone);
    }

    public function dateTime(?string $format = null, ?string $timezone = null): static
    {
        return parent::dateTime($format ?? 'F j, Y h:i A', $timezone);
    }

    public function money(null|string|Closure $currency = null, int $divideBy = 0, null|string|Closure $locale = null): static
    {
        return parent::money($currency ?? 'PHP', $divideBy, $locale);
    }

    public function timezone(string|Closure|null $timezone): static
    {
        return parent::timezone($timezone ?? 'Asia/Manila');
    }
}
