<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HasRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $nutritionist = Role::create(['name' => 'nutritionist']);

        $admin->givePermissionTo(Permission::all());
        $nutritionist->givePermissionTo([
            'create nutrition',
            'view nutrition',
            'edit nutrition',
            'delete nutrition',
        ]);
    }
}
