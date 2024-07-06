<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions menus
        Permission::create(['name' => 'index menus']);
        Permission::create(['name' => 'create menus']);
        Permission::create(['name' => 'edit menus']);
        Permission::create(['name' => 'delete menus']);

        // create permissions transactions
        Permission::create(['name' => 'index transactions']);
        Permission::create(['name' => 'create transactions']);
        Permission::create(['name' => 'edit transactions']);
        Permission::create(['name' => 'show transactions']);
        Permission::create(['name' => 'delete transactions']);
        Permission::create(['name' => 'print receipt']);
        Permission::create(['name' => 'export transactions']);

        // create permissions categories
        Permission::create(['name' => 'index categories']);
        Permission::create(['name' => 'create categories']);
        Permission::create(['name' => 'edit categories']);
        Permission::create(['name' => 'delete categories']);

        // create roles and assign existing permissions
        $cashier = Role::create(['name' => 'cashier']);
        $cashier->givePermissionTo('index transactions');
        $cashier->givePermissionTo('create transactions');
        $cashier->givePermissionTo('edit transactions');
        $cashier->givePermissionTo('print receipt');

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('index menus');
        $admin->givePermissionTo('create menus');
        $admin->givePermissionTo('edit menus');
        $admin->givePermissionTo('delete menus');
        $admin->givePermissionTo('index categories');
        $admin->givePermissionTo('create categories');
        $admin->givePermissionTo('edit categories');
        $admin->givePermissionTo('delete categories');
        $admin->givePermissionTo('export transactions');

        $superadmin = Role::create(['name' => 'superadmin']);

        // create superadmin
        $user = \App\Models\User::factory()->create([
            'name' => 'Superadmin',
            'email' => 'elsakcf@gmail.com',
        ]);
        $user->assignRole($superadmin);

        // create admin
        $user = \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);
        $user->assignRole($admin);

        // create cashier
        $user = \App\Models\User::factory()->create([
            'name' => 'Cashier',
            'email' => 'kasir@example.com',
        ]);
        $user->assignRole($cashier);
    }
}
