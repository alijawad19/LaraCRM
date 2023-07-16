<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'manage contact']);

        Role::create(['name' => 'admin']); // gets all permissions via Gate::before rule; see app/Providers/AuthServiceProvider
        Role::create(['name' => 'user'])->givePermissionTo(['manage contact']);
    }
}
