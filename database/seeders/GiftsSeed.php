<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GiftsSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar multiplos presentes
        DB::table('gifts')->insert([
            [
                'contact_id' => 8,
                'name' => 'XBOX 360',
                'description' => 'Um videogame da microsoft.',
                'price' => 600.60,
                'date_of_purchase' => now()->format('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'contact_id' => 8,
                'name' => 'PS2',
                'description' => 'Um videogame da antigo de colecionador.',
                'price' => 800.99,
                'date_of_purchase' => now()->format('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'contact_id' => 7,
                'name' => 'XBOX 360',
                'description' => 'Um videogame da microsoft.',
                'price' => 600.60,
                'date_of_purchase' => now()->format('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'contact_id' => 6,
                'name' => 'PS2',
                'description' => 'Um videogame da antigo de colecionador.',
                'price' => 800.99,
                'date_of_purchase' => now()->format('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
