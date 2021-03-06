<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);

        factory(User::class)->create([
            'name' => 'User',
            'email' => 'user@example.com',
        ]);

        factory(User::class, 10)->create();
    }
}
