<?php

use App\Filament\Resources\FirstTimeJobSeekerResource\Pages\CreateFirstTimeJobSeeker;
use App\Filament\Resources\FirstTimeJobSeekerResource\Pages\EditFirstTimeJobSeeker;
use App\Filament\Resources\FirstTimeJobSeekerResource\Pages\ListFirstTimeJobSeekers;
use App\Models\Barangay;
use App\Models\Course;
use App\Models\EducationalLevel;
use App\Models\FirstTimeJobSeeker;
use App\Models\Sex;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Actions\RestoreAction;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Excel;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Laravel\seed;
use function Pest\Livewire\livewire;
use function PHPUnit\Framework\assertContains;
use function PHPUnit\Framework\assertEqualsCanonicalizing;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

function seekerFactory()
{
    return FirstTimeJobSeeker::factory()->for(auth()->user()->barangay);
}

beforeEach(function () {
    // seed database
    seed();
    // create test user with barangay
    $user = User::factory()->for(Barangay::find(1))->create();
    // login
    auth()->login($user);
});

test('can list first-time job seekers', function () {
    $seekers = seekerFactory()->count(10)->create();

    get(ListFirstTimeJobSeekers::getUrl())
        ->assertOk();

    livewire(ListFirstTimeJobSeekers::class)
        ->assertCanRenderTableColumn('month_year')
        ->assertCanRenderTableColumn('first_name')
        ->assertCanRenderTableColumn('last_name')
        ->assertCanRenderTableColumn('middle_name')
        ->assertCanRenderTableColumn('age')
        ->assertCanRenderTableColumn('birth_date')
        ->assertCanRenderTableColumn('sex')
        ->assertCanRenderTableColumn('educational_level')
        ->assertCanRenderTableColumn('course')
        ->assertCanSeeTableRecords($seekers);
});

test('can add first-time job seeker', function () {
    $data = seekerFactory()->raw();

    get(CreateFirstTimeJobSeeker::getUrl())
        ->assertOk();

    livewire(CreateFirstTimeJobSeeker::class)
        ->fillForm($data)
        ->call('create')
        ->assertHasNoFormErrors();

    assertDatabaseHas(FirstTimeJobSeeker::class, $data);
});

test('can edit first-time job seeker', function () {
    $seeker = seekerFactory()->create();
    $key = $seeker->getRouteKey();
    $currentData = collect($seeker->getAttributes())->only($seeker->getFillable())->toArray();
    $newData = seekerFactory()->raw();
    
    get(EditFirstTimeJobSeeker::getUrl(['record' => $key]))
        ->assertOk();

    livewire(EditFirstTimeJobSeeker::class, ['record' => $key])
        ->assertFormSet($currentData)
        ->fillForm($newData)
        ->call('save')
        ->assertHasNoFormErrors();
    
    $seeker->refresh();
    $savedData = collect($seeker->getAttributes())->only($seeker->getFillable())->toArray();
    assertEqualsCanonicalizing($newData, $savedData);
});

test('can delete first-time job seeker', function () {
    $seeker = seekerFactory()->create();
    $key = $seeker->getRouteKey();

    livewire(EditFirstTimeJobSeeker::class, ['record' => $key])
        ->callAction(DeleteAction::class)
        ->assertHasNoActionErrors();

    assertFalse(FirstTimeJobSeeker::all()->contains($seeker));
});

test('can restore deleted first-time job seeker', function () {
    $seeker = seekerFactory()->create();
    $key = $seeker->getRouteKey();
    $seeker->delete();

    livewire(EditFirstTimeJobSeeker::class, ['record' => $key])
        ->callAction(RestoreAction::class)
        ->assertHasNoActionErrors();
    
    $seeker->refresh();
    assertFalse($seeker->trashed());
});

test('can export table to CSV', function () {
    // create inhabitants
    seekerFactory()->count(10)->create();
    // visit page
    exportTable(ListFirstTimeJobSeekers::class, Excel::CSV)
        // assert
        ->assertFileDownloaded();
});

test('can export table to XLS', function () {
    // create inhabitants
    seekerFactory()->count(10)->create();
    // visit page
    exportTable(ListFirstTimeJobSeekers::class, Excel::XLS)
        // assert
        ->assertFileDownloaded();
});

test('can export seleted records to CSV', function () {
    // create inhabitants
    $records = seekerFactory()->count(10)->create();
    // visit page
    exportSelectedRecords(ListFirstTimeJobSeekers::class, $records, Excel::CSV)
        // assert
        ->assertFileDownloaded();
});

test('can export selected records to XLS', function () {
    // create inhabitants
    $records = seekerFactory()->count(10)->create();
    // visit page
    exportSelectedRecords(ListFirstTimeJobSeekers::class, $records, Excel::XLS)
        // assert
        ->assertFileDownloaded();
});
