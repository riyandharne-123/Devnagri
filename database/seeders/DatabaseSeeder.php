<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;

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
        
        \App\Models\Role::factory(10)->create();
        \App\Models\User::factory(10)->create();
    }
}
