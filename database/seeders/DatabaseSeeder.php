<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Permission;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('test123'),
            'api_token' => Str::random(80),
            'role_id' => 1
        ]);

        Role::create([
            'name' => 'admin',
        ]);

        Permission::create([
            'user_id' => 1,
            'name' => 'users'
        ]);

        Permission::create([
            'user_id' => 1,
            'name' => 'roles'
        ]);

        Permission::create([
            'user_id' => 1,
            'name' => 'juniors'
        ]);
    
    }
}
