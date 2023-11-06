<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // barangay users
        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'add users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        // barangay zones
        Permission::create(['name' => 'list zones']);
        Permission::create(['name' => 'view zones']);
        Permission::create(['name' => 'create zones']);
        Permission::create(['name' => 'edit zones']);
        Permission::create(['name' => 'delete zones']);
        // barangay streets
        // barangay households
        // barangay residents
        // barangay resident history
        // documents templates
        // document requests
        // barangay personnel
        Role::create(['name' => 'Superadministrator']);
        Role::create(['name' => 'Barangay Administrator']);
        Role::create(['name' => 'Punong Barangay']);
        Role::create(['name' => 'Barangay Secretary']);
        Role::create(['name' => 'Barangay Kagawad']);
        Role::create(['name' => 'Barangay Treasurer']);
    }
}
