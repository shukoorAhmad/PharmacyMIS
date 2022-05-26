<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => '$2y$10$sMPjh5ErDBRvw34wotvOuOQXRLz27o38SOcfWdDYu3HEq3CstUSSe', // 12345678
            ],

        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
