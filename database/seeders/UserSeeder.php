<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'role_name' => 'superadmin',
        ]);
        User::create([
            'name' => 'admin',
            'role_id' => 1,
            'email' => 'example@gmail.com',
            'password' => Hash::make('admin123'),
        ]);
    }
}
