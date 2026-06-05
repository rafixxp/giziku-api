<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Nadila Nuryadina',
            'email' => 'nadilanuryadina@gizi.id',
            'phone_number' => '085133447788',
            'password' => Hash::make('nadila!')
        ]);

        $nutritionist = User::create([
            'name' => 'Sarah',
            'email' => 'sarah@gizi.id',
            'phone_number' => '085133447788',
            'password' => Hash::make('sarah!')
        ]);

        $admin->assignRole('admin');
        $nutritionist->assignRole('nutritionist');
    }
}
