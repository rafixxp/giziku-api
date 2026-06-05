<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create nutrition']);
        Permission::create(['name' => 'view nutrition']);
        Permission::create(['name' => 'edit nutrition']);
        Permission::create(['name' => 'delete nutrition']);

        Permission::create(['name' => 'view report']);
        Permission::create(['name' => 'manage users']);
    }
}
