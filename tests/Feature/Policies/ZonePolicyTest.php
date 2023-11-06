<?php

namespace Tests\Feature\Policies;

use App\Models\User;
use App\Models\Zone;
use Database\Seeders\BarangaySeeder;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ZonePolicyTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(BarangaySeeder::class);
        $this->seed(RolesAndPermissionsSeeder::class);
    }

    public function test_any_user_can_list_zones_from_same_barangay()
    {
        $user = User::factory()->create(['barangay_id' => 1]);
        $this->actingAs($user);
        $this->assertTrue($user->can('viewAny', Zone::class));
    }
}
