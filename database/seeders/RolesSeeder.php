<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'web.create.reviews']);
        Permission::create(['name' => 'web.delete.reviews']);
        Permission::create(['name' => 'web.update.reviews']);

        Permission::create(['name' => 'web.create.comments']);
        Permission::create(['name' => 'web.delete.comments']);
        Permission::create(['name' => 'web.update.comments']);

        Permission::create(['name' => 'web.create.likes']);
        Permission::create(['name' => 'web.delete.likes']);

        Permission::create(['name' => 'dashboard.read']);
        Permission::create(['name' => 'dashboard.create']);
        Permission::create(['name' => 'dashboard.delete']);
        Permission::create(['name' => 'dashboard.update']);

        $admin_role = Role::create(['name' => 'Admin']);
        $user_role = Role::create(['name' => 'User']);

        $admin_role->givePermissionTo([
            'dashboard.read',
            'dashboard.create',
            'dashboard.delete',
            'dashboard.update',
        ]);

        $user_role->givePermissionTo([
            'web.create.reviews',
            'web.delete.reviews',
            'web.update.reviews',
            'web.create.comments',
            'web.delete.comments',
            'web.update.comments',
            'web.create.likes',
            'web.delete.likes',
        ]);
    }
}
