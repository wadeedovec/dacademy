<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        // Create Permissions
        Permission::create(['name' => 'create-exam']);
        Permission::create(['name' => 'edit-exam']);
        Permission::create(['name' => 'delete-exam']);
        Permission::create(['name' => 'view-exam']);
        Permission::create(['name' => 'perform-exam']);
        Permission::create(['name' => 'create-user']);
        Permission::create(['name' => 'edit-user']);
        Permission::create(['name' => 'view-user']);
        Permission::create(['name' => 'delete-user']);

        // Create Roles
        $adminRole = Role::create(['name' => 'admin']);
        $managerRole = Role::create(['name' => 'manager']);
        $userRole = Role::create(['name' => 'user']);

        // Assign Permissions to Admin Role
        $adminRole->givePermissionTo(['create-exam', 'edit-exam', 'delete-exam', 'view-exam', 'create-user', 'edit-user', 'view-user', 'delete-user']);
        $userRole->givePermissionTo('view-exam','perform-exam');
    }
}
