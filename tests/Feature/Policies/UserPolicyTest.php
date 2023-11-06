<?php

namespace Tests\Feature\Policies;

use App\Models\User;
use Database\Seeders\BarangaySeeder;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserPolicyTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(BarangaySeeder::class);
        $this->seed(RolesAndPermissionsSeeder::class);
    }

    public function test_superadministrator_can_list_all_users()
    {
        $user = User::factory()->create();
        $user->assignRole('Superadministrator');
        $this->assertTrue($user->can('list users'));
        $this->actingAs($user);

        $this->assertTrue($user->can('viewAny', User::class));

        $user1 = User::factory()->create(['barangay_id' => 1]);
        $user2 = User::factory()->create(['barangay_id' => 2]);
        $users = User::all();
        $this->assertTrue($users->contains($user1));
        $this->assertTrue($users->contains($user2));
    }
    
    public function test_barangay_administrator_can_only_list_users_from_same_barangay()
    {
        $user = User::factory()->create(['barangay_id' => 1]);
        $user->assignRole('Barangay Administrator');
        $this->assertTrue($user->can('list users'));
        $this->actingAs($user);

        $this->assertTrue($user->can('viewAny', User::class));
        
        $user1 = User::factory()->create(['barangay_id' => 1]);
        $user2 = User::factory()->create(['barangay_id' => 2]);
        $users = User::all();
        $this->assertTrue($users->contains($user1));
        $this->assertFalse($users->contains($user2));
    }

    public function test_normal_user_cannot_list_users()
    {
        $user = User::factory()->create(['barangay_id' => 1]);
        $this->assertFalse($user->can('list users'));
        $this->actingAs($user);
        
        $this->assertFalse($user->can('viewAny', User::class));
    }

    public function test_user_can_view_own_user_details()
    {
        $user = User::factory()->create(['barangay_id' => 1]);
        $this->assertTrue($user->can('view', $user));
    }

    public function test_normal_user_cannot_view_other_users()
    {
        $user = User::factory()->create(['barangay_id' => 1]);
        $user2 = User::factory()->create();
        $this->assertFalse($user->can('view', $user2));
    }
    
    public function test_superadministrator_can_create_users()
    {
        $user = User::factory()->create();
        $user->assignRole('Superadministrator');
        $this->assertTrue($user->can('create', User::class));
    }
    
    public function test_barangay_administrator_cannot_create_users()
    {
        $user = User::factory()->create();
        $user->assignRole('Barangay Administrator');
        $this->assertFalse($user->can('create', User::class));
    }

    public function test_user_can_edit_own_user_details()
    {
        $user = User::factory()->create(['barangay_id' => 1]);
        $this->assertTrue($user->can('update', $user));
    }

    public function test_normal_user_cannot_edit_other_users()
    {
        $user = User::factory()->create(['barangay_id' => 1]);
        $user2 = User::factory()->create();
        $this->assertFalse($user->can('update', $user2));
    }

    public function test_superadministrator_can_delete_users()
    {
        $user = User::factory()->create();
        $user->assignRole('Superadministrator');
        $user2 = User::factory()->create();
        $this->assertTrue($user->can('delete', $user2));
    }

    public function test_barangay_administrator_cannot_delete_users()
    {
        $user = User::factory()->create();
        $user->assignRole('Barangay Administrator');
        $user2 = User::factory()->create();
        $this->assertFalse($user->can('delete', $user2));
    }
}
