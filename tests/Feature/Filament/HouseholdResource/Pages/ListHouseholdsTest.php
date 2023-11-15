<?php

use App\Filament\Resources\HouseholdResource\Pages\ListHouseholds;
use App\Models\Household;
use App\Models\User;
use Maatwebsite\Excel\Excel;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\seed;
use function Pest\Livewire\livewire;

beforeEach(function () {
    seed();
    $user = User::find(2);
    actingAs($user);
});

test('can list households', function () {
    Household::create(['number' => 'test001']);
    $page = livewire(ListHouseholds::class);
    $page->assertCanSeeTableRecords(Household::all());
});

test('can filter to see deleted households', function () {
    $household = Household::create(['number' => 'test001']);
    $household->delete();
    $page = livewire(ListHouseholds::class);
    $page->filterTable('trashed', true);
    $page->assertCanSeeTableRecords(Household::all());
});

test('has export table action', function () {
    $page = livewire(ListHouseholds::class);
    $page->assertTableActionExists('export_table');
});

test('has export selected action', function () {
    $page = livewire(ListHouseholds::class);
    $page->assertTableBulkActionExists('export_selected');
});

/**
 * NOTE ABOUT EXPORT TABLE
 * 
 * filters and columns used in the table are included,
 * except the pagination. By default. all records are exported.
 */

test('can export table as csv', function () {
    $page = livewire(ListHouseholds::class);
    $page->callTableAction('export_table', data: [
        'export.writer_type' => Excel::CSV,
    ]);
    $page->assertFileDownloaded();
});

test('can export table as xls', function () {
    $page = livewire(ListHouseholds::class);
    $page->callTableAction('export_table', data: [
        'export.writer_type' => Excel::XLS,
    ]);
    $page->assertFileDownloaded();
});

test('can export table as xlsx', function () {
    $page = livewire(ListHouseholds::class);
    $page->callTableAction('export_table', data: [
        'export.writer_type' => Excel::XLSX,
    ]);
    $page->assertFileDownloaded();
});

test('can export selected as csv', function () {
    Household::create(['number' => 'test001']);
    $page = livewire(ListHouseholds::class);
    $page->callTableBulkAction('export_selected', Household::all(), data: [
        'export.writer_type' => Excel::CSV,
    ]);
    $page->assertFileDownloaded();
});

test('can export selected as xls', function () {
    Household::create(['number' => 'test001']);
    $page = livewire(ListHouseholds::class);
    $page->callTableBulkAction('export_selected', Household::all(), data: [
        'export.writer_type' => Excel::XLS,
    ]);
    $page->assertFileDownloaded();
});

test('can export selected as xlsx', function () {
    Household::create(['number' => 'test001']);
    $page = livewire(ListHouseholds::class);
    $page->callTableBulkAction('export_selected', Household::all(), data: [
        'export.writer_type' => Excel::XLSX,
    ]);
    $page->assertFileDownloaded();
});
