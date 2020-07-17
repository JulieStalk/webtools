<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a default user for testing
        factory(User::class)->create([
            'email' => 'admin@example.com',
            'role'  => 'admin'
        ]);

        factory(User::class)->create([
            'email' => 'admin2@example.com',
            'role'  => 'admin'
        ]);
        
        factory(User::class)->create([
            'email' => 'admin3@example.com',
            'role'  => 'admin'
        ]);

        factory(User::class, 100)->create();
    }
}
