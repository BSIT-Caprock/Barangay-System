@php
    $barangayName = \App\Models\Setting::first()->barangay_name;
@endphp

<div class="flex items-center gap-x-3">
    <img alt="Laravel logo" src="storage/logo.png" class="fi-logo flex" style='height: 3rem'>
    <div class="text-xl font-bold leading-5 tracking-tight text-gray-950 dark:text-white">{{ $barangayName }}</div>
</div>
