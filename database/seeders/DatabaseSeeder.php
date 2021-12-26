<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'is_admin' => true,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => \bcrypt('password')
        ]);
        User::factory(100)->create();
    }
}
