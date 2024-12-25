<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create multiple users
        DB::table('users')->insert([
            [
                'email' => 'user1@gmail.com',
                'password' => bcrypt('123456'),
                'name' => 'user1',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'email' => 'user2@gmail.com',
                'password' => bcrypt('123456'),
                'name' => 'user2',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'email' => 'user3@gmail.com',
                'password' => bcrypt('123456'),
                'name' => 'user3',
                'created_at' => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
