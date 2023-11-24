<?php

namespace Tests\Feature;

use App\Models\User;
use Spatie\Permission\PermissionServiceProvider;
use Spatie\Permission\Traits\HasRoles;
use Tests\TestCase;

class SetupSpatiePermissionsTest extends TestCase
{
    public function test_spatie_permission_config_exists(): void
    {
        $permission = config('permission');
        $this->assertNotNull($permission);
    }

    public function test_spatie_permissions_is_in_config_app_providers(): void
    {
        $spatie = PermissionServiceProvider::class;
        $this->assertContains($spatie, config('app.providers'));
    }

    public function test_user_model_uses_hasroles_trait(): void
    {
        $user_has_roles = in_array(HasRoles::class, class_uses_recursive(User::class));
        $this->assertTrue($user_has_roles);
    }
}
