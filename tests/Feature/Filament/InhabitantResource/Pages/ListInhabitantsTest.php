<?php

use App\Filament\Resources\InhabitantResource\Pages\ListInhabitants;
use App\Models\Inhabitant;
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

test('can list inhabitants', function () {
    Inhabitant::factory()->create();
    $page = livewire(ListInhabitants::class);
    $page->assertCanSeeTableRecords(Inhabitant::all());
});

test('can filter to see deleted inhabitants', function () {
    $inhabitant = Inhabitant::factory()->create();
    $inhabitant->delete();
    $page = livewire(ListInhabitants::class);
    $page->filterTable('trashed', true);
    $page->assertCanSeeTableRecords(Inhabitant::all());
});

test('has export table action', function () {
    $page = livewire(ListInhabitants::class);
    $page->assertTableActionExists('export_table');
});

test('has export selected action', function () {
    $page = livewire(ListInhabitants::class);
    $page->assertTableBulkActionExists('export_selected');
});

/**
 * NOTE ABOUT EXPORT TABLE
 * 
 * filters and columns used in the table are included,
 * except the pagination. By default. all records are exported.
 */

test('can export table as csv', function () {
    $page = livewire(ListInhabitants::class);
    $page->callTableAction('export_table', data: [
        'export.writer_type' => Excel::CSV,
    ]);
    $page->assertFileDownloaded();
});

test('can export table as xls', function () {
    $page = livewire(ListInhabitants::class);
    $page->callTableAction('export_table', data: [
        'export.writer_type' => Excel::XLS,
    ]);
    $page->assertFileDownloaded();
});

test('can export table as xlsx', function () {
    $page = livewire(ListInhabitants::class);
    $page->callTableAction('export_table', data: [
        'export.writer_type' => Excel::XLSX,
    ]);
    $page->assertFileDownloaded();
});

test('can export selected as csv', function () {
    Inhabitant::factory()->create();
    $page = livewire(ListInhabitants::class);
    $page->callTableBulkAction('export_selected', Inhabitant::all(), data: [
        'export.writer_type' => Excel::CSV,
    ]);
    $page->assertFileDownloaded();
});

test('can export selected as xls', function () {
    Inhabitant::factory()->create();
    $page = livewire(ListInhabitants::class);
    $page->callTableBulkAction('export_selected', Inhabitant::all(), data: [
        'export.writer_type' => Excel::XLS,
    ]);
    $page->assertFileDownloaded();
});

test('can export selected as xlsx', function () {
    Inhabitant::factory()->create();
    $page = livewire(ListInhabitants::class);
    $page->callTableBulkAction('export_selected', Inhabitant::all(), data: [
        'export.writer_type' => Excel::XLSX,
    ]);
    $page->assertFileDownloaded();
});
