<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Create Permissions
        Permission::create(['name' => 'create exams']);
        Permission::create(['name' => 'edit exams']);
        Permission::create(['name' => 'delete exams']);

        // Create Roles
        $adminRole = Role::create(['name' => 'admin']);
        $managerRole = Role::create(['name' => 'manager']);
        $userRole = Role::create(['name' => 'user']);

        // Assign Permissions to Admin Role
        $adminRole->givePermissionTo(['create exams', 'edit exams', 'delete exams']);
    }
}
